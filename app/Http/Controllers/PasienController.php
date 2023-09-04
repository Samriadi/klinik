<?php

namespace App\Http\Controllers;
use PDF;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PasienController extends Controller
{
    public function index()
    {
        $record = pasien::all(); // Retrieve all pasien from the database
        return view('pages.pasien.index', ['nama_pasien' => $record , 'type_menu' => '']);
    }

    public function desc($id)
    {
        //get data from database
        $record = Pasien::where('id_pasien', $id)->get();
        $nama_pasien = $record->pluck('nama_pasien');
        $kode_pasien = $record->pluck('kode_pasien');
        $kategori_pasien = $record->pluck('kategori_pasien');
        $umur_pasien = $record->pluck('umur_pasien');
        $jkel_pasien = $record->pluck('jkel_pasien');
        $nohp_pasien = $record->pluck('nohp_pasien');

        $powerPow = 103;
        $powerMod = 403;

        //convert to array
        $arr_nama_pasien = $nama_pasien->toArray();
        $arr_kode_pasien = $kode_pasien->toArray();
        $arr_kategori_pasien = $kategori_pasien->toArray();
        $arr_umur_pasien = $umur_pasien->toArray();
        $arr_jkel_pasien = $jkel_pasien->toArray();
        $arr_nohp_pasien = $nohp_pasien->toArray();
       
        //convert string array to numeric array
        $str_nama_pasien = implode(" ", $arr_nama_pasien);  $int_nama_pasien = explode(" ", $str_nama_pasien);
        $str_kode_pasien = implode(" ", $arr_kode_pasien);  $int_kode_pasien = explode(" ", $str_kode_pasien);
        $str_kategori_pasien = implode(" ", $arr_kategori_pasien);  $int_kategori_pasien = explode(" ", $str_kategori_pasien);
        $str_umur_pasien = implode(" ", $arr_umur_pasien);  $int_umur_pasien = explode(" ", $str_umur_pasien);
        $str_jkel_pasien = implode(" ", $arr_jkel_pasien);  $int_jkel_pasien = explode(" ", $str_jkel_pasien);
        $str_nohp_pasien = implode(" ", $arr_nohp_pasien);  $int_nohp_pasien = explode(" ", $str_nohp_pasien);
     
        //convert integer to array
        $int_arr_nama_pasien = array_map('intval', $int_nama_pasien);
        $int_arr_kode_pasien = array_map('intval', $int_kode_pasien);
        $int_arr_kategori_pasien = array_map('intval', $int_kategori_pasien);
        $int_arr_umur_pasien = array_map('intval', $int_umur_pasien);
        $int_arr_jkel_pasien = array_map('intval', $int_jkel_pasien);
        $int_arr_nohp_pasien = array_map('intval', $int_nohp_pasien);
       
        //handle pow
        $pow_nama_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_nama_pasien);
        $pow_kode_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_kode_pasien);
        $pow_kategori_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_kategori_pasien);
        $pow_umur_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_umur_pasien);
        $pow_jkel_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_jkel_pasien);
        $pow_nohp_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_nohp_pasien);

        //handle mod
        $modulo_nama_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_nama_pasien);
        $modulo_kode_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_kode_pasien);
        $modulo_kategori_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_kategori_pasien);
        $modulo_umur_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_umur_pasien);
        $modulo_jkel_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_jkel_pasien);
        $modulo_nohp_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_nohp_pasien);

        //convert to ascii
        $ascii_nama_pasien = array_map('chr', $modulo_nama_pasien);
        $ascii_kode_pasien = array_map('chr', $modulo_kode_pasien);
        $ascii_kategori_pasien = array_map('chr', $modulo_kategori_pasien);
        $ascii_umur_pasien = array_map('chr', $modulo_umur_pasien);
        $ascii_jkel_pasien = array_map('chr', $modulo_jkel_pasien);
        $ascii_nohp_pasien = array_map('chr', $modulo_nohp_pasien);

        //descipt
        $desc_nama_pasien = implode($ascii_nama_pasien);
        $desc_kode_pasien = implode($ascii_kode_pasien);
        $desc_kategori_pasien = implode($ascii_kategori_pasien);
        $desc_umur_pasien = implode($ascii_umur_pasien);
        $desc_jkel_pasien = implode($ascii_jkel_pasien);
        $desc_nohp_pasien = implode($ascii_nohp_pasien);

        return view('pages.pasien.desc', [
            'nama_pasien' => $desc_nama_pasien,
            'kode_pasien' => $str_kode_pasien,
            'kategori_pasien' => $desc_kategori_pasien,
            'umur_pasien' => $desc_umur_pasien,
            'jkel_pasien' => $desc_jkel_pasien,
            'nohp_pasien' => $desc_nohp_pasien,
        ], [ 'type_menu' => '']);

    }

    function customPowerPow($number, $power) {
        return bcpow($number, $power);
    }
    
    function customPowerMod($number, $power) {
        return bcmod($number, $power);
    }

    public function tambah(){
        return view('pages.pasien.tambah', [ 'type_menu' => '']);
    }
    public function add(){
        return view('pages.pasien.add', [ 'type_menu' => '']);
    }

    public function store(Request $request)
    {
        $nama_pasien = $request->input('nama_pasien');
        $kode_pasien = $request->input('kode_pasien');
        $kategori_pasien = $request->input('kategori_pasien');
        $umur_pasien = $request->input('umur_pasien');
        $jkel_pasien = $request->input('jkel_pasien');
        $nohp_pasien = $request->input('nohp_pasien');
        
        $ascii_nama_pasien = $this->stringToAscii($nama_pasien);
        $ascii_kode_pasien = $this->stringToAscii($kode_pasien);
        $ascii_kategori_pasien = $this->stringToAscii($kategori_pasien);
        $ascii_umur_pasien = $this->stringToAscii($umur_pasien);
        $ascii_jkel_pasien = $this->stringToAscii($jkel_pasien);
        $ascii_nohp_pasien = $this->stringToAscii($nohp_pasien);

        $modulo_nama_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_nama_pasien);
        $modulo_kode_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_kode_pasien);
        $modulo_kategori_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_kategori_pasien);
        $modulo_umur_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_umur_pasien);
        $modulo_jkel_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_jkel_pasien);
        $modulo_nohp_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_nohp_pasien);

        $str_nama_pasien = implode(" ", $modulo_nama_pasien);
        $str_kode_pasien = implode(" ", $modulo_kode_pasien);
        $str_kategori_pasien = implode(" ", $modulo_kategori_pasien);
        $str_umur_pasien = implode(" ", $modulo_umur_pasien);
        $str_jkel_pasien = implode(" ", $modulo_jkel_pasien);
        $str_nohp_pasien = implode(" ", $modulo_nohp_pasien);
        $timestamp = Carbon::now();

        // insert data ke table 
        Pasien::insert([
            'nama_pasien' => $str_nama_pasien,
            'kode_pasien' => $kode_pasien,
            'kategori_pasien' => $str_kategori_pasien,
            'umur_pasien' => $str_umur_pasien,
            'jkel_pasien' => $str_jkel_pasien,
            'nohp_pasien' => $str_nohp_pasien,
            'created_at' => $timestamp,
        ]);
        // alihkan halaman ke halaman 
        return redirect('data-pasien');
    }

    private function stringToAscii($string)
    {
        $asciiValues = [];

        for ($i = 0; $i < strlen($string); $i++) {
            $asciiValues[] = ord($string[$i]);
        }

        return $asciiValues;
    }
    
    public function edit($id)
    {
        $pasien = Pasien::where('id_pasien', $id)->get();  
        $id_pasien = $pasien->pluck('id_pasien');
        $nama_pasien = $pasien->pluck('nama_pasien');
        $kode_pasien = $pasien->pluck('kode_pasien');
        $kategori_pasien = $pasien->pluck('kategori_pasien');
        $umur_pasien = $pasien->pluck('umur_pasien');
        $jkel_pasien = $pasien->pluck('jkel_pasien');
        $nohp_pasien = $pasien->pluck('nohp_pasien');

        $powerPow = 103;
        $powerMod = 403;

        //convert to array
        $arr_nama_pasien = $nama_pasien->toArray();
        $arr_kode_pasien = $kode_pasien->toArray();
        $arr_kategori_pasien = $kategori_pasien->toArray();
        $arr_umur_pasien = $umur_pasien->toArray();
        $arr_jkel_pasien = $jkel_pasien->toArray();
        $arr_nohp_pasien = $nohp_pasien->toArray();
       
        //convert string array to numeric array
        $str_nama_pasien = implode(" ", $arr_nama_pasien);  $int_nama_pasien = explode(" ", $str_nama_pasien);
        $str_kode_pasien = implode(" ", $arr_kode_pasien);  $int_kode_pasien = explode(" ", $str_kode_pasien);
        $str_kategori_pasien = implode(" ", $arr_kategori_pasien);  $int_kategori_pasien = explode(" ", $str_kategori_pasien);
        $str_umur_pasien = implode(" ", $arr_umur_pasien);  $int_umur_pasien = explode(" ", $str_umur_pasien);
        $str_jkel_pasien = implode(" ", $arr_jkel_pasien);  $int_jkel_pasien = explode(" ", $str_jkel_pasien);
        $str_nohp_pasien = implode(" ", $arr_nohp_pasien);  $int_nohp_pasien = explode(" ", $str_nohp_pasien);
     
        //convert integer to array
        $int_arr_nama_pasien = array_map('intval', $int_nama_pasien);
        $int_arr_kode_pasien = array_map('intval', $int_kode_pasien);
        $int_arr_kategori_pasien = array_map('intval', $int_kategori_pasien);
        $int_arr_umur_pasien = array_map('intval', $int_umur_pasien);
        $int_arr_jkel_pasien = array_map('intval', $int_jkel_pasien);
        $int_arr_nohp_pasien = array_map('intval', $int_nohp_pasien);
       
        //handle pow
        $pow_nama_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_nama_pasien);
        $pow_kode_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_kode_pasien);
        $pow_kategori_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_kategori_pasien);
        $pow_umur_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_umur_pasien);
        $pow_jkel_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_jkel_pasien);
        $pow_nohp_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_nohp_pasien);

        //handle mod
        $modulo_nama_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_nama_pasien);
        $modulo_kode_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_kode_pasien);
        $modulo_kategori_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_kategori_pasien);
        $modulo_umur_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_umur_pasien);
        $modulo_jkel_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_jkel_pasien);
        $modulo_nohp_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_nohp_pasien);

        //convert to ascii
        $ascii_nama_pasien = array_map('chr', $modulo_nama_pasien);
        $ascii_kode_pasien = array_map('chr', $modulo_kode_pasien);
        $ascii_kategori_pasien = array_map('chr', $modulo_kategori_pasien);
        $ascii_umur_pasien = array_map('chr', $modulo_umur_pasien);
        $ascii_jkel_pasien = array_map('chr', $modulo_jkel_pasien);
        $ascii_nohp_pasien = array_map('chr', $modulo_nohp_pasien);

        //descipt
        $desc_nama_pasien = implode("",$ascii_nama_pasien);
        $desc_kode_pasien = implode($ascii_kode_pasien);
        $desc_kategori_pasien = implode($ascii_kategori_pasien);
        $desc_umur_pasien = implode($ascii_umur_pasien);
        $desc_jkel_pasien = implode($ascii_jkel_pasien);
        $desc_nohp_pasien = implode($ascii_nohp_pasien);

        // passing data pasien yang didapat ke view edit.blade.php
        return view('pages.pasien.edit', [
            'type_menu' => '', 
            'id_pasien' => $id_pasien,
            'nama_pasien' => $desc_nama_pasien,
            'kode_pasien' => $str_kode_pasien,
            'kategori_pasien' => $desc_kategori_pasien,
            'umur_pasien' => $desc_umur_pasien,
            'jkel_pasien' => $desc_jkel_pasien,
            'nohp_pasien' => $desc_nohp_pasien,
        ]);
    
    }

    public function update(Request $request)
    {
        $id_pasien = $request->id_pasien;
        $nama_pasien = $request->nama_pasien;
        $kode_pasien = $request->kode_pasien;
        $kategori_pasien = $request->kategori_pasien;
        $umur_pasien = $request->umur_pasien;
        $jkel_pasien = $request->jkel_pasien;
        $nohp_pasien = $request->nohp_pasien;
        
        $ascii_nama_pasien = $this->stringToAscii($nama_pasien);
        $ascii_kode_pasien = $this->stringToAscii($kode_pasien);
        $ascii_kategori_pasien = $this->stringToAscii($kategori_pasien);
        $ascii_umur_pasien = $this->stringToAscii($umur_pasien);
        $ascii_jkel_pasien = $this->stringToAscii($jkel_pasien);
        $ascii_nohp_pasien = $this->stringToAscii($nohp_pasien);

        $modulo_nama_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_nama_pasien);
        $modulo_kode_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_kode_pasien);
        $modulo_kategori_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_kategori_pasien);
        $modulo_umur_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_umur_pasien);
        $modulo_jkel_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_jkel_pasien);
        $modulo_nohp_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_nohp_pasien);

        $str_nama_pasien = implode(" ", $modulo_nama_pasien);
        $str_kode_pasien = implode(" ", $modulo_kode_pasien);
        $str_kategori_pasien = implode(" ", $modulo_kategori_pasien);
        $str_umur_pasien = implode(" ", $modulo_umur_pasien);
        $str_jkel_pasien = implode(" ", $modulo_jkel_pasien);
        $str_nohp_pasien = implode(" ", $modulo_nohp_pasien);

        Pasien::where('kode_pasien',$kode_pasien)->update([
            'nama_pasien' => $str_nama_pasien,
            'kode_pasien' => $kode_pasien,
            'kategori_pasien' => $str_kategori_pasien,
            'umur_pasien' => $str_umur_pasien,
            'jkel_pasien' => $str_jkel_pasien,
            'nohp_pasien' => $str_nohp_pasien,
        ]);
        
       
        return redirect('data-pasien');
    }

    public function hapus($id)
    {
       
        Pasien::where('id_pasien',$id)->delete();
    
        return redirect('data-pasien');
    }

    // public function generatePDF()
    // {
    //     $pdf = PDF::loadView('pdf');

    //     return $pdf->download('example.pdf');
    // }

    public function save(Request $request)
    {
        $nama_pasien = $request->input('nama_pasien');
        $kode_pasien = $request->input('kode_pasien');
        $kategori_pasien = $request->input('kategori_pasien');
        $umur_pasien = $request->input('umur_pasien');
        $jkel_pasien = $request->input('jkel_pasien');
        $nohp_pasien = $request->input('nohp_pasien');
        
        $ascii_nama_pasien = $this->stringToAscii($nama_pasien);
        $ascii_kategori_pasien = $this->stringToAscii($kategori_pasien);
        $ascii_umur_pasien = $this->stringToAscii($umur_pasien);
        $ascii_jkel_pasien = $this->stringToAscii($jkel_pasien);
        $ascii_nohp_pasien = $this->stringToAscii($nohp_pasien);


        $modulo_nama_pasien = array_map(function ($value, $index) {return $this->EnkripsiElgamal($value, $index); }, $ascii_nama_pasien, array_keys($ascii_nama_pasien));
        $modulo_kategori_pasien = array_map(function ($value, $index) {return $this->EnkripsiElgamal($value, $index); }, $ascii_kategori_pasien, array_keys($ascii_kategori_pasien));
        $modulo_umur_pasien = array_map(function ($value, $index) {return $this->EnkripsiElgamal($value, $index); }, $ascii_umur_pasien, array_keys($ascii_umur_pasien));
        $modulo_jkel_pasien = array_map(function ($value, $index) {return $this->EnkripsiElgamal($value, $index); }, $ascii_jkel_pasien, array_keys($ascii_jkel_pasien));
        $modulo_nohp_pasien = array_map(function ($value, $index) {return $this->EnkripsiElgamal($value, $index); }, $ascii_nohp_pasien, array_keys($ascii_nohp_pasien));

        $enkrip_nama_pasien = array();
        foreach ($modulo_nama_pasien as $subArray) { foreach ($subArray as $element) { $enkrip_nama_pasien[] = $element;}}
        $enkrip_kategori_pasien = array();
        foreach ($modulo_kategori_pasien as $subArray) { foreach ($subArray as $element) { $enkrip_kategori_pasien[] = $element;}}
        $enkrip_umur_pasien = array();
        foreach ($modulo_umur_pasien as $subArray) { foreach ($subArray as $element) { $enkrip_umur_pasien[] = $element;}}
        $enkrip_jkel_pasien = array();
        foreach ($modulo_jkel_pasien as $subArray) { foreach ($subArray as $element) { $enkrip_jkel_pasien[] = $element;}}
        $enkrip_nohp_pasien = array();
        foreach ($modulo_nohp_pasien as $subArray) { foreach ($subArray as $element) { $enkrip_nohp_pasien[] = $element;}}

        // $twoDimArray = array();
        // $row = array(); // Subarray untuk setiap baris
        // foreach ($arraySatuDimensi as $element) {
        //     $row[] = $element;
        //     if (count($row) == 2) { // Setiap dua elemen, tambahkan ke array dua dimensi
        //         $twoDimArray[] = $row;
        //         $row = array(); // Reset subarray
        //     }
        // }
        // dd($arraySatuDimensi, $twoDimArray);


        $str_nama_pasien = implode(",", $enkrip_nama_pasien);
        $str_kategori_pasien = implode(" ", $enkrip_kategori_pasien);
        $str_umur_pasien = implode(" ", $enkrip_umur_pasien);
        $str_jkel_pasien = implode(" ", $enkrip_jkel_pasien);
        $str_nohp_pasien = implode(" ", $enkrip_nohp_pasien);
        $timestamp = Carbon::now();

        // insert data ke table 
        Pasien::insert([
            'nama_pasien' => $str_nama_pasien,
            'kode_pasien' => $kode_pasien,
            'kategori_pasien' => $str_kategori_pasien,
            'umur_pasien' => $str_umur_pasien,
            'jkel_pasien' => $str_jkel_pasien,
            'nohp_pasien' => $str_nohp_pasien,
            'created_at' => $timestamp,
        ]);
        // alihkan halaman ke halaman 
        return redirect('data-pasien');
    }

    public function saveElgamal($item){
        $pow=7;
        $mod=403;

        if($item%2==0)
        {
        return $item**$pow%$mod;
        }
        else
        {
        return $item+2;
        }
    }
    public function getArrayItem($arr){
 
        if($arr%2==0)
        {
        return 0;
        }
        else
        {
        return 1;
        }
    }
    public function EnkripsiElgamal($a){
 
            $p=257;
            $g=2;
            $x=255;
            $y=129;

            $m=$a;
            $k=rand(1, 7);

            //menhitung nilai gamma
            $gk= bcpow($g, $k);
            $gamma = bcmod($gk, $p);

            //menghitung nilai delta
            $yk = bcpow($y, $k);
            $ykm = strval($yk*$m);
            // dd($ykm);
            $delta = bcmod($ykm, $p);

            return [$gamma, $delta];
    }

    public function DekripsiElgamal($twoDimArray){
 
      
}
}
