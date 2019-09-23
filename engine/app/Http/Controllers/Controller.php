<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	function angkaTerbilang($angka){
		$angka = (int) $angka;
		$huruf=["","Satu","Dua","Tiga","Empat","Lima","Enam","Tujuh","Delapan","Sembilan","Sepuluh","Sebelas"];

		if($angka < 12){
			return $huruf[$angka];
		}
		if($angka >=12 && $angka <= 19){
			return $huruf[$angka % 10] . " Belas";
		}
		if($angka >= 20 && $angka <= 99){
			return $this->angkaTerbilang($angka / 10) . " Puluh " . $huruf[$angka % 10];
		}
		if($angka >= 100 && $angka <= 199){
			return "Seratus " . $this->angkaTerbilang($angka % 100);
		}
		if($angka >= 200 && $angka <= 999){
			return $this->angkaTerbilang($angka / 100) . " Ratus " . $this->angkaTerbilang($angka % 100);
		}
		if($angka >= 1000 && $angka <= 1999){
			return "Seribu " . $this->angkaTerbilang($angka % 1000);
		}
		if($angka >= 2000 && $angka <= 999999){
			return $this->angkaTerbilang($angka / 1000) . " Ribu " . $this->angkaTerbilang($angka % 1000);
		}
		if($angka >= 1000000 && $angka <= 999999999){
			return $this->angkaTerbilang($angka / 1000000) . " Juta " . $this->angkaTerbilang($angka % 1000000);
		}
		if($angka >= 1000000000 && $angka <= 999999999999){
			return $this->angkaTerbilang($angka / 1000000000) . " Milyar " . $this->angkaTerbilang($angka % 1000000000);
		}
		if($angka >= 1000000000000 && $angka <= 999999999999999){
			return $this->angkaTerbilang($angka / 1000000000000) . " Triliun " . $this->angkaTerbilang($angka % 1000000000000);
		}
		if($angka >= 1000000000000000 && $angka <= 999999999999999999){
			return $this->angkaTerbilang($angka / 1000000000000000) . " Quadrilyun " . $this->angkaTerbilang($angka % 1000000000000000);
		}
		return "";
    }

    function romanNumber($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}
