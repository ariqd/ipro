<?php

use Illuminate\Database\Seeder;

class UpdateAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->where('username', 'admin')->update(['role' => 'admin']);
    }
}
