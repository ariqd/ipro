<?php
/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/blob/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @copyright  Copyright (c) 2010 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
 */

use Mockery\CompositeExpectation;
use Mockery\Configuration;
use Mockery\Container;
use Mockery\ExpectationInterface;
use Mockery\Generator\CachingGenerator;
use Mockery\Generator\Generator;
use Mockery\Generator\MockConfigurationBuilder;
use Mockery\Generator\StringManipulationGenerator;
use Mockery\Loader\EvalLoader;
use Mockery\Loader\Loader;
use Mockery\Matcher\AndAnyOtherArgs;
use Mockery\Matcher\Any;
use Mockery\Matcher\AnyOf;
use Mockery\Matcher\Contains;
use Mockery\Matcher\Ducktype;
use Mockery\Matcher\HasKey;
use Mockery\Matcher\HasValue;
use Mockery\Matcher\MatcherAbstract;
use Mockery\ClosureWrapper;
use Mockery\Matcher\MustBe;
use Mockery\Matcher\Not;
use Mockery\Matcher\NotAnyOf;
use Mockery\Matcher\Pattern;
use Mockery\Matcher\Subset;
use Mockery\Matcher\Type;
use Mockery\Mock;
use Mockery\MockInterface;

class Mockery
{
    const BLOCKS = 'Mockery_Forward_Blocks';

    /**
     * Global container to hold all mocks for the current unit test running.
     *
     * @var Container|null
     */
    protected static $_container = null;

    /**
     * Global configuration handler containing configuration options.
     *
     * @var Configuration
     */
    protected static $_config = null;

    /**
     * @var Generator
     */
    protected static $_generator;

    /**
     * @var Loader
     */
    protected static $_loader;

    /**
     * @var array
     */
    private static $_filesToCleanUp = [];

    /**
     * Defines the global helper functions
     *
     * @return void
     */
    public static function globalHelpers()
    {
        require_once __DIR__.'/helpers.php';
    }

    /**
     * @return array
     */
    public static function builtInTypes()
    {
        $builtInTypes = array(
            'self',
            'array',
            'callable',
            // Up to php 7
            'bool',
            'float',
            'int',
            'string',
            'iterable',
            'void',
        );

        if (version_compare(PHP_VERSION, '7.2.0-dev') >= 0) {
            $builtInTypes[] = 'object';
        }

        return $builtInTypes;
    }

    /**
     * @param string $type
     * @return bool
     */
    public static function isBuiltInType($type)
    {
        return in_array($type, Mockery::builtInTypes());
    }

    /**
     * Static shortcut to \Mockery\Container::mock().
     *
     * @param mixed ...$args
     *
     * @return MockInterface
     */
    public static function mock(...$args)
    {
        return call_user_func_array(array(self::getContainer(), 'mock'), $args);
    }

    /**
     * Static and semantic shortcut for getting a mock from the container
     * and applying the spy's expected behavior into it.
     *
     * @param mixed ...$args
     *
     * @return MockInterface
     */
    public static function spy(...$args)
    {
        if (count($args) && $args[0] instanceof Closure) {
            $args[0] = new ClosureWrapper($args[0]);
        }

        return call_user_func_array(array(self::getContainer(), 'mock'), $args)->shouldIgnoreMissing();
    }

    /**
     * Static and Semantic shortcut to \Mockery\Container::mock().
     *
     * @param mixed ...$args
     *
     * @return MockInterface
     */
    public static function instanceMock(...$args)
    {
        return call_user_func_array(array(self::getContainer(), 'mock'), $args);
    }

    /**
     * Static shortcut to \Mockery\Container::mock(), first argument names the mock.
     *
     * @param mixed ...$args
     *
     * @return MockInterface
     */
    public static function namedMock(...$args)
    {
        $name = array_shift($args);

        $builder = new MockConfigurationBuilder();
        $builder->setName($name);

        array_unshift($args, $builder);

        return call_user_func_array(array(self::getContainer(), 'mock'), $args);
    }

    /**
     * Static shortcut to \Mockery\Container::self().
     *
     * @throws LogicException
     *
     * @return MockInterface
     */
    public static function self()
    {
        if (is_null(self::$_container)) {
            throw new LogicException('You have not declared any mocks yet');
        }

        return self::$_container->self();
    }

    /**
     * Static shortcut to closing up and verifying all mocks in the global
     * container, and resetting the container static variable to null.
     *
     * @return void
     */
    public static function close()
    {
        foreach (self::$_filesToCleanUp as $fileName) {
            @unlink($fileName);
        }
        self::$_filesToCleanUp = [];

        if (is_null(self::$_container)) {
            return;
        }

        $container = self::$_container;
        self::$_container = null;

        $container->mockery_teardown();
        $container->mockery_close();
    }

    /**
     * Static fetching of a mock associated with a name or explicit class poser.
     *
     * @param string $name
     *
     * @return Mock
     */
    public static function fetchMock($name)
    {
        return self::$_container->fetchMock($name);
    }

    /**
     * Lazy loader and getter for
     * the container property.
     *
     * @return Mockery\Container
     */
    public static function getContainer()
    {
        if (is_null(self::$_container)) {
            self::$_container = new Mockery\Container(self::getGenerator(), self::getLoader());
        }

        return self::$_container;
    }

    /**
     * Setter for the $_generator static propery.
     *
     * @param Generator $generator
     */
    public static function setGenerator(Generator $generator)
    {
        self::$_generator = $generator;
    }

    /**
     * Lazy loader method and getter for
     * the generator property.
     *
     * @return Generator
     */
    public static function getGenerator()
    {
        if (is_null(self::$_generator)) {
            self::$_generator = self::getDefaultGenerator();
        }

        return self::$_generator;
    }

    /**
     * Creates and returns a default generator
     * used inside this class.
     *
     * @return CachingGenerator
     */
    public static function getDefaultGenerator()
    {
        return new CachingGenerator(StringManipulationGenerator::withDefaultPasses());
    }

    /**
     * Setter for the $_loader static property.
     *
     * @param Loader $loader
     */
    public static function setLoader(Loader $loader)
    {
        self::$_loader = $loader;
    }

    /**
     * Lazy loader method and getter for
     * the $_loader property.
     *
     * @return Loader
     */
    public static function getLoader()
    {
        if (is_null(self::$_loader)) {
            self::$_loader = self::getDefaultLoader();
        }

        return self::$_loader;
    }

    /**
     * Gets an EvalLoader to be used as default.
     *
     * @return EvalLoader
     */
    public static function getDefaultLoader()
    {
        return new EvalLoader();
    }

    /**
     * Set the container.
     *
     * @param Container $container
     *
     * @return Container
     */
    public static function setContainer(Mockery\Container $container)
    {
        return self::$_container = $container;
    }

    /**
     * Reset the container to null.
     *
     * @return void
     */
    public static function resetContainer()
    {
        self::$_container = null;
    }

    /**
     * Return instance of ANY matcher.
     *
     * @return Any
     */
    public static function any()
    {
        return new Any();
    }

    /**
     * Return instance of AndAnyOtherArgs matcher.
     *
     * An alternative name to `andAnyOtherArgs` so
     * the API stays closer to `any` as well.
     *
     * @return AndAnyOtherArgs
     */
    public static function andAnyOthers()
    {
        return new AndAnyOtherArgs();
    }

    /**
     * Return instance of AndAnyOtherArgs matcher.
     *
     * @return AndAnyOtherArgs
     */
    public static function andAnyOtherArgs()
    {
        return new AndAnyOtherArgs();
    }

    /**
     * Return instance of TYPE matcher.
     *
     * @param mixed $expected
     *
     * @return Type
     */
    public static function type($expected)
    {
        return new Type($expected);
    }

    /**
     * Return instance of DUCKTYPE matcher.
     *
     * @param array ...$args
     *
     * @return Ducktype
     */
    public static function ducktype(...$args)
    {
        return new Ducktype($args);
    }

    /**
     * Return instance of SUBSET matcher.
     *
     * @param array $part
     * @param bool $strict - (Optional) True for strict comparison, false for loose
     *
     * @return Subset
     */
    public static function subset(array $part, $strict = true)
    {
        return new Subset($part, $strict);
    }

    /**
     * Return instance of CONTAINS matcher.
     *
     * @param array ...$args
     *
     * @return Contains
     */
    public static function contains(...$args)
    {
        return new Contains($args);
    }

    /**
     * Return instance of HASKEY matcher.
     *
     * @param mixed $key
     *
     * @return HasKey
     */
    public static function hasKey($key)
    {
        return new HasKey($key);
    }

    /**
     * Return instance of HASVALUE matcher.
     *
     * @param mixed $val
     *
     * @return HasValue
     */
    public static function hasValue($val)
    {
        return new HasValue($val);
    }

    /**
     * Return instance of CLOSURE matcher.
     *
     * @param mixed $closure
     *
     * @return \Mockery\Matcher\Closure
     */
    public static function on($closure)
    {
        return new \Mockery\Matcher\Closure($closure);
    }

    /**
     * Return instance of MUSTBE matcher.
     *
     * @param mixed $expected
     *
     * @return MustBe
     */
    public static function mustBe($expected)
    {
        return new MustBe($expected);
    }

    /**
     * Return instance of NOT matcher.
     *
     * @param mixed $expected
     *
     * @return Not
     */
    public static function not($expected)
    {
        return new Not($expected);
    }

    /**
     * Return instance of ANYOF matcher.
     *
     * @param array ...$args
     *
     * @return AnyOf
     */
    public static function anyOf(...$args)
    {
        return new AnyOf($args);
    }

    /**
     * Return instance of NOTANYOF matcher.
     *
     * @param array ...$args
     *
     * @return NotAnyOf
     */
    public static function notAnyOf(...$args)
    {
        return new NotAnyOf($args);
    }

    /**
     * Return instance of PATTERN matcher.
     *
     * @param mixed $expected
     *
     * @return Pattern
     */
    public static function pattern($expected)
    {
        return new Pattern($expected);
    }

    /**
     * Lazy loader and Getter for the global
     * configuration container.
     *
     * @return Configuration
     */
    public static function getConfiguration()
    {
        if (is_null(self::$_config)) {
            self::$_config = new Configuration();
        }

        return self::$_config;
    }

    /**
     * Utility method to format method name and arguments into a string.
     *
     * @param string $method
     * @param array $arguments
     *
     * @return string
     */
    public static function formatArgs($method, array $arguments = null)
    {
        if (is_null($arguments)) {
            return $method . '()';
        }

        $formattedArguments = array();
        foreach ($arguments as $argument) {
            $formattedArguments[] = self::formatArgument($argument);
        }

        return $method . '(' . implode(', ', $formattedArguments) . ')';
    }

    /**
     * Gets the string representation
     * of any passed argument.
     *
     * @param mixed $argument
     * @param int $depth
     *
     * @return mixed
     */
    private static function formatArgument($argument, $depth = 0)
    {
        if ($argument instanceof MatcherAbstract) {
            return (string) $argument;
        }

        if (is_object($argument)) {
            return 'object(' . get_class($argument) . ')';
        }

        if (is_int($argument) || is_float($argument)) {
            return $argument;
        }

        if (is_array($argument)) {
            if ($depth === 1) {
                $argument = '[...]';
            } else {
                $sample = array();
                foreach ($argument as $key => $value) {
                    $key = is_int($key) ? $key : "'$key'";
                    $value = self::formatArgument($value, $depth + 1);
                    $sample[] = "$key => $value";
                }

                $argument = "[".implode(", ", $sample)."]";
            }

            return ((strlen($argument) > 1000) ? substr($argument, 0, 1000).'...]' : $argument);
        }

        if (is_bool($argument)) {
            return $argument ? 'true' : 'false';
        }

        if (is_resource($argument)) {
            return 'resource(...)';
        }

        if (is_null($argument)) {
            return 'NULL';
        }

        return "'".(string) $argument."'";
    }

    /**
     * Utility function to format objects to printable arrays.
     *
     * @param array $objects
     *
     * @return string
     */
    public static function formatObjects(array $objects = null)
    {
        static $formatting;

        if ($formatting) {
            return '[Recursion]';
        }

        if (is_null($objects)) {
            return '';
        }

        $objects = array_filter($objects, 'is_object');
        if (empty($objects)) {
            return '';
        }

        $formatting = true;
        $parts = array();

        foreach ($objects as $object) {
            $parts[get_class($object)] = self::objectToArray($object);
        }

        $formatting = false;

        return 'Objects: ( ' . var_export($parts, true) . ')';
    }

    /**
     * Utility function to turn public properties and public get* and is* method values into an array.
     *
     * @param object $object
     * @param int $nesting
     *
     * @return array
     */
    private static function objectToArray($object, $nesting = 3)
    {
        if ($nesting == 0) {
            return array('...');
        }

        return array(
            'class' => get_class($object),
            'properties' => self::extractInstancePublicProperties($object, $nesting)
        );
    }

    /**
     * Returns all public instance properties.
     *
     * @param mixed $object
     * @param int $nesting
     *
     * @return array
     */
    private static function extractInstancePublicProperties($object, $nesting)
    {
        $reflection = new ReflectionClass(get_class($object));
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        $cleanedProperties = array();

        foreach ($properties as $publicProperty) {
            if (!$publicProperty->isStatic()) {
                $name = $publicProperty->getName();
                $cleanedProperties[$name] = self::cleanupNesting($object->$name, $nesting);
            }
        }

        return $cleanedProperties;
    }

    /**
     * Utility method used for recursively generating
     * an object or array representation.
     *
     * @param mixed $argument
     * @param int $nesting
     *
     * @return mixed
     */
    private static function cleanupNesting($argument, $nesting)
    {
        if (is_object($argument)) {
            $object = self::objectToArray($argument, $nesting - 1);
            $object['class'] = get_class($argument);

            return $object;
        }

        if (is_array($argument)) {
            return self::cleanupArray($argument, $nesting - 1);
        }

        return $argument;
    }

    /**
     * Utility method for recursively
     * gerating a representation
     * of the given array.
     *
     * @param array $argument
     * @param int $nesting
     *
     * @return mixed
     */
    private static function cleanupArray($argument, $nesting = 3)
    {
        if ($nesting == 0) {
            return '...';
        }

        foreach ($argument as $key => $value) {
            if (is_array($value)) {
                $argument[$key] = self::cleanupArray($value, $nesting - 1);
            } elseif (is_object($value)) {
                $argument[$key] = self::objectToArray($value, $nesting - 1);
            }
        }

        return $argument;
    }

    /**
     * Utility function to parse shouldReceive() arguments and generate
     * expectations from such as needed.
     *
     * @param Mockery\MockInterface $mock
     * @param array ...$args
     * @param callable $add
     * @return CompositeExpectation
     */
    public static function parseShouldReturnArgs(MockInterface $mock, $args, $add)
    {
        $composite = new CompositeExpectation();

        foreach ($args as $arg) {
            if (is_array($arg)) {
                foreach ($arg as $k => $v) {
                    $expectation = self::buildDemeterChain($mock, $k, $add)->andReturn($v);
                    $composite->add($expectation);
                }
            } elseif (is_string($arg)) {
                $expectation = self::buildDemeterChain($mock, $arg, $add);
                $composite->add($expectation);
            }
        }

        return $composite;
    }

    /**
     * Sets up expectations on the members of the CompositeExpectation and
     * builds up any demeter chain that was passed to shouldReceive.
     *
     * @param MockInterface $mock
     * @param string $arg
     * @param callable $add
     * @throws Mockery\Exception
     * @return ExpectationInterface
     */
    protected static function buildDemeterChain(MockInterface $mock, $arg, $add)
    {
        /** @var Mockery\Container $container */
        $container = $mock->mockery_getContainer();
        $methodNames = explode('->', $arg);
        reset($methodNames);

        if (!Mockery::getConfiguration()->mockingNonExistentMethodsAllowed()
            && !$mock->mockery_isAnonymous()
            && !in_array(current($methodNames), $mock->mockery_getMockableMethods())
        ) {
            throw new \Mockery\Exception(
                'Mockery\'s configuration currently forbids mocking the method '
                . current($methodNames) . ' as it does not exist on the class or object '
                . 'being mocked'
            );
        }

        /** @var ExpectationInterface|null $expectations */
        $expectations = null;

        /** @var Callable $nextExp */
        $nextExp = function ($method) use ($add) {
            return $add($method);
        };

        $parent = get_class($mock);

        while (true) {
            $method = array_shift($methodNames);
            $expectations = $mock->mockery_getExpectationsFor($method);

            if (is_null($expectations) || self::noMoreElementsInChain($methodNames)) {
                $expectations = $nextExp($method);
                if (self::noMoreElementsInChain($methodNames)) {
                    break;
                }

                $mock = self::getNewDemeterMock($container, $parent, $method, $expectations);
            } else {
                $demeterMockKey = $container->getKeyOfDemeterMockFor($method, $parent);
                if ($demeterMockKey) {
                    $mock = self::getExistingDemeterMock($container, $demeterMockKey);
                }
            }

            $parent .= '->' . $method;

            $nextExp = function ($n) use ($mock) {
                return $mock->shouldReceive($n);
            };
        }

        return $expectations;
    }

    /**
     * Gets a new demeter configured
     * mock from the container.
     *
     * @param Container $container
     * @param string $parent
     * @param string $method
     * @param Mockery\ExpectationInterface $exp
     *
     * @return Mock
     */
    private static function getNewDemeterMock(
        Mockery\Container $container,
        $parent,
        $method,
        Mockery\ExpectationInterface $exp
    ) {
        $newMockName = 'demeter_' . md5($parent) . '_' . $method;

        if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
            $parRef = null;
            $parRefMethod = null;
            $parRefMethodRetType = null;

            $parentMock = $exp->getMock();
            if ($parentMock !== null) {
                $parRef = new ReflectionObject($parentMock);
            }

            if ($parRef !== null && $parRef->hasMethod($method)) {
                $parRefMethod = $parRef->getMethod($method);
                $parRefMethodRetType = $parRefMethod->getReturnType();

                if ($parRefMethodRetType !== null) {
                    $mock = self::namedMock($newMockName, (string) $parRefMethodRetType);
                    $exp->andReturn($mock);

                    return $mock;
                }
            }
        }

        $mock = $container->mock($newMockName);
        $exp->andReturn($mock);

        return $mock;
    }

    /**
     * Gets an specific demeter mock from
     * the ones kept by the container.
     *
     * @param Container $container
     * @param string $demeterMockKey
     *
     * @return mixed
     */
    private static function getExistingDemeterMock(
        Mockery\Container $container,
        $demeterMockKey
    ) {
        $mocks = $container->getMocks();
        $mock = $mocks[$demeterMockKey];

        return $mock;
    }

    /**
     * Checks if the passed array representing a demeter
     * chain with the method names is empty.
     *
     * @param array $methodNames
     *
     * @return bool
     */
    private static function noMoreElementsInChain(array $methodNames)
    {
        return empty($methodNames);
    }

    public static function declareClass($fqn)
    {
        return static::declareType($fqn, "class");
    }

    public static function declareInterface($fqn)
    {
        return static::declareType($fqn, "interface");
    }

    private static function declareType($fqn, $type)
    {
        $targetCode = "<?php ";
        $shortName = $fqn;

        if (strpos($fqn, "\\")) {
            $parts = explode("\\", $fqn);

            $shortName = trim(array_pop($parts));
            $namespace = implode("\\", $parts);

            $targetCode.= "namespace $namespace;\n";
        }

        $targetCode.= "$type $shortName {} ";

        /*
         * We could eval here, but it doesn't play well with the way
         * PHPUnit tries to backup global state and the require definition
         * loader
         */
        $tmpfname = tempnam(sys_get_temp_dir(), "Mockery");
        file_put_contents($tmpfname, $targetCode);
        require $tmpfname;
        Mockery::registerFileForCleanUp($tmpfname);
    }

    /**
     * Register a file to be deleted on tearDown.
     *
     * @param string $fileName
     */
    public static function registerFileForCleanUp($fileName)
    {
        self::$_filesToCleanUp[] = $fileName;
    }
}
