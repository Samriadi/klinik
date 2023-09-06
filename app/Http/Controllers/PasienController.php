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

    public function tambah(){
        return view('pages.pasien.tambah', [ 'type_menu' => '']);
    }

    public function add(){
        return view('pages.pasien.add', [ 'type_menu' => '']);
    }

    

    function customPowerPow($number, $power) {
        return bcpow($number, $power);
    }
    
    function customPowerMod($number, $power) {
        return bcmod($number, $power);
    }

    public function EncryptRSA($plaintext){
        $ascii = $this->stringToAscii($plaintext);
        $modulo = array_map(function ($item) { 
            return $item**3%319; 
        }, $ascii);

        $chipertext = implode(" ", $modulo);
        return $chipertext;
    }

    public function DecryptRSA($chipertext){
        $e = 187;
        $n = 319;

        $int = explode(" ", $chipertext);
        $int_arr = array_map('intval', $int);

        $pow  = array_map(function($m) use ($e) { return $this->customPowerPow($m, $e); 
        }, $int_arr);

        $modulo  = array_map(function($num) use ($n) { return $this->customPowerMod($num, $n);
        }, $pow);

        $ascii = array_map('chr', $modulo);
        $plaintext = implode($ascii);

        return $plaintext;
    }

    public function store(Request $request)
    {
        $nama_pasien = $request->input('nama_pasien');
        $kode_pasien = $request->input('kode_pasien');
        $kategori_pasien = $request->input('kategori_pasien');
        $umur_pasien = $request->input('umur_pasien');
        $jkel_pasien = $request->input('jkel_pasien');
        $nohp_pasien = $request->input('nohp_pasien');
        
        $chipertext_nama_pasien = $this->EncryptRSA($nama_pasien);
        $chipertext_kategori_pasien= $this->EncryptRSA($kategori_pasien);
        $chipertext_umur_pasien = $this->EncryptRSA($umur_pasien);
        $chipertext_jkel_pasien = $this->EncryptRSA($jkel_pasien);
        $chipertext_nohp_pasien = $this->EncryptRSA($nohp_pasien);
        $timestamp = Carbon::now();

        // insert data ke table 
        Pasien::insert([
            'nama_pasien' => $chipertext_nama_pasien,
            'kode_pasien' => $kode_pasien,
            'kategori_pasien' => $chipertext_kategori_pasien,
            'umur_pasien' => $chipertext_umur_pasien,
            'jkel_pasien' => $chipertext_jkel_pasien,
            'nohp_pasien' => $chipertext_nohp_pasien,
            'role' => 0,
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

    public function desc($id)
    {
        //get data from database
        $record = Pasien::where('id_pasien', $id)->first();
        $nama_pasien = $record->nama_pasien;
        $kode_pasien = $record->kode_pasien;
        $kategori_pasien = $record->kategori_pasien;
        $umur_pasien = $record->umur_pasien;
        $jkel_pasien = $record->jkel_pasien;
        $nohp_pasien = $record->nohp_pasien;

        $plaintext_nama_pasien = $this->DecryptRSA($nama_pasien);
        $plaintext_kategori_pasien = $this->DecryptRSA($kategori_pasien);
        $plaintext_umur_pasien = $this->DecryptRSA($umur_pasien);
        $plaintext_jkel_pasien = $this->DecryptRSA($jkel_pasien);
        $plaintext_nohp_pasien = $this->DecryptRSA($nohp_pasien);

        return view('pages.pasien.desc', [
            'nama_pasien' => $plaintext_nama_pasien,
            'kode_pasien' => $kode_pasien,
            'kategori_pasien' => $plaintext_kategori_pasien,
            'umur_pasien' => $plaintext_umur_pasien,
            'jkel_pasien' => $plaintext_jkel_pasien,
            'nohp_pasien' => $plaintext_nohp_pasien,
        ], [ 'type_menu' => '']);

    }

    public function edit($id)
    {
        $record = Pasien::where('id_pasien', $id)->first();
        $id_pasien = $record->id_pasien;
        $nama_pasien = $record->nama_pasien;
        $kode_pasien = $record->kode_pasien;
        $kategori_pasien = $record->kategori_pasien;
        $umur_pasien = $record->umur_pasien;
        $jkel_pasien = $record->jkel_pasien;
        $nohp_pasien = $record->nohp_pasien;

        $plaintext_nama_pasien = $this->DecryptRSA($nama_pasien);
        $plaintext_kategori_pasien = $this->DecryptRSA($kategori_pasien);
        $plaintext_umur_pasien = $this->DecryptRSA($umur_pasien);
        $plaintext_jkel_pasien = $this->DecryptRSA($jkel_pasien);
        $plaintext_nohp_pasien = $this->DecryptRSA($nohp_pasien);

        // passing data pasien yang didapat ke view edit.blade.php
        return view('pages.pasien.edit', [
            'type_menu' => '', 
            'id_pasien' => $id_pasien,
            'nama_pasien' => $plaintext_nama_pasien,
            'kode_pasien' => $kode_pasien,
            'kategori_pasien' => $plaintext_kategori_pasien,
            'umur_pasien' => $plaintext_umur_pasien,
            'jkel_pasien' => $plaintext_jkel_pasien,
            'nohp_pasien' => $plaintext_nohp_pasien,
        ]);
    
    }

    public function update(Request $request)
    {
        $nama_pasien = $request->nama_pasien;
        $kode_pasien = $request->kode_pasien;
        $kategori_pasien = $request->kategori_pasien;
        $umur_pasien = $request->umur_pasien;
        $jkel_pasien = $request->jkel_pasien;
        $nohp_pasien = $request->nohp_pasien;
        
        $chipertext_nama_pasien = $this->EncryptRSA($nama_pasien);
        $chipertext_kategori_pasien= $this->EncryptRSA($kategori_pasien);
        $chipertext_umur_pasien = $this->EncryptRSA($umur_pasien);
        $chipertext_jkel_pasien = $this->EncryptRSA($jkel_pasien);
        $chipertext_nohp_pasien = $this->EncryptRSA($nohp_pasien);

        Pasien::where('kode_pasien',$kode_pasien)->update([
            'nama_pasien' => $chipertext_nama_pasien,
            'kode_pasien' => $kode_pasien,
            'kategori_pasien' => $chipertext_kategori_pasien,
            'umur_pasien' => $chipertext_umur_pasien,
            'jkel_pasien' => $chipertext_jkel_pasien,
            'nohp_pasien' => $chipertext_nohp_pasien,
        ]);
       
        return redirect('data-pasien');
    }

    public function hapus($id)
    {
       
        Pasien::where('id_pasien',$id)->delete();
    
        return redirect('data-pasien');
    }

    public function save(Request $request)
    {
        $nama_pasien = $request->input('nama_pasien');
        $kode_pasien = $request->input('kode_pasien');
        $kategori_pasien = $request->input('kategori_pasien');
        $umur_pasien = $request->input('umur_pasien');
        $jkel_pasien = $request->input('jkel_pasien');
        $nohp_pasien = $request->input('nohp_pasien');
        
        $chipertext_nama_pasien = $this->EnryptElgamal($nama_pasien);
        $chipertext_kategori_pasien = $this->EnryptElgamal($kategori_pasien);
        $chipertext_umur_pasien = $this->EnryptElgamal($umur_pasien);
        $chipertext_jkel_pasien = $this->EnryptElgamal($jkel_pasien);
        $chipertext_nohp_pasien = $this->EnryptElgamal($nohp_pasien);
        $timestamp = Carbon::now();

        // insert data ke table 
        Pasien::insert([
            'nama_pasien' => $chipertext_nama_pasien,
            'kode_pasien' => $kode_pasien,
            'kategori_pasien' => $chipertext_kategori_pasien,
            'umur_pasien' => $chipertext_umur_pasien,
            'jkel_pasien' => $chipertext_jkel_pasien,
            'nohp_pasien' => $chipertext_nohp_pasien,
            'role' => 1,
            'created_at' => $timestamp,
        ]);
        // alihkan halaman ke halaman 

        // Log::info(json_encode($modulo_nama_pasien));

        return redirect('data-pasien');
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
        $delta = bcmod($ykm, $p);
        Log::info(" New Random K : ".$k);
        return [$gamma, $delta];
    }

    public function DekripsiElgamal($a){
        $x=$a[0]*$a[1];
        $m= bcmod($x,"257");
        return $m;
    }

    public function DecryptElgamal($chipertext){
        $int = explode(" ", $chipertext);
        $int_arr = array_map('intval', $int);
        $twoDimArray = array();
        $row = array(); 

        foreach ($int_arr as $element)  {$row[] = $element;
            if (count($row) == 2){ 
                  $twoDimArray[] = $row; 
                $row = array(); }}

        $modulo = array_map(function ($value) { return $this->DekripsiElgamal($value); 
        }, $twoDimArray, array_keys($twoDimArray));

        $ascii = array_map('chr', $modulo);

        $plaintext = implode($ascii);

        return $plaintext;
    }

    public function EnryptElgamal($plaintext){

        $ascii = $this->stringToAscii($plaintext);

        $modulo = array_map(function ($value, $index)  { return $this->EnkripsiElgamal($value, $index); 
        }, $ascii, array_keys($ascii));

        $enkrip = array();
        foreach ($modulo as $subArray) {foreach ($subArray as $element) { $enkrip[] = $element;}}

        $chipertext = implode(" ", $enkrip);

        return $chipertext;
    }

    public function deks($id)
    {
        //get data from database
        $record = Pasien::where('id_pasien', $id)->first();
        $nama_pasien = $record->nama_pasien;
        $kode_pasien = $record->kode_pasien;
        $kategori_pasien = $record->kategori_pasien;
        $umur_pasien = $record->umur_pasien;
        $jkel_pasien = $record->jkel_pasien;
        $nohp_pasien = $record->nohp_pasien;
     
        //descipt
        $desc_nama_pasien = $this->DecryptElgamal($nama_pasien);
        $desc_kategori_pasien = $this->DecryptElgamal($kategori_pasien);
        $desc_umur_pasien = $this->DecryptElgamal($umur_pasien);
        $desc_jkel_pasien = $this->DecryptElgamal($jkel_pasien);
        $desc_nohp_pasien = $this->DecryptElgamal($nohp_pasien);

        return view('pages.pasien.desc', [
            'nama_pasien' => $desc_nama_pasien,
            'kode_pasien' => $kode_pasien,
            'kategori_pasien' => $desc_kategori_pasien,
            'umur_pasien' => $desc_umur_pasien,
            'jkel_pasien' => $desc_jkel_pasien,
            'nohp_pasien' => $desc_nohp_pasien,
        ], [ 'type_menu' => '']);

    }
    public function ubah($id)
    {
         //get data from database
         $record = Pasien::where('id_pasien', $id)->first();
         $id_pasien = $record->id_pasien;
         $nama_pasien = $record->nama_pasien;
         $kode_pasien = $record->kode_pasien;
         $kategori_pasien = $record->kategori_pasien;
         $umur_pasien = $record->umur_pasien;
         $jkel_pasien = $record->jkel_pasien;
         $nohp_pasien = $record->nohp_pasien;

        //descipt
        $plaintext_nama_pasien = $this->DecryptElgamal($nama_pasien);
        $plaintext_kategori_pasien = $this->DecryptElgamal($kategori_pasien);
        $plaintext_umur_pasien = $this->DecryptElgamal($umur_pasien);
        $plaintext_jkel_pasien = $this->DecryptElgamal($jkel_pasien);
        $plaintext_nohp_pasien = $this->DecryptElgamal($nohp_pasien);

        return view('pages.pasien.ubah', [
            'type_menu' => '', 
            'id_pasien' => $id_pasien,
            'nama_pasien' => $plaintext_nama_pasien,
            'kode_pasien' => $kode_pasien,
            'kategori_pasien' => $plaintext_kategori_pasien,
            'umur_pasien' => $plaintext_umur_pasien,
            'jkel_pasien' => $plaintext_jkel_pasien,
            'nohp_pasien' => $plaintext_nohp_pasien,
        ]);
    
    }
    public function put(Request $request)
    {
        $nama_pasien = $request->nama_pasien;
        $kode_pasien = $request->kode_pasien;
        $kategori_pasien = $request->kategori_pasien;
        $umur_pasien = $request->umur_pasien;
        $jkel_pasien = $request->jkel_pasien;
        $nohp_pasien = $request->nohp_pasien;
        
        $chipertext_nama_pasien = $this->EnryptElgamal($nama_pasien);
        $chipertext_kategori_pasien = $this->EnryptElgamal($kategori_pasien);
        $chipertext_umur_pasien = $this->EnryptElgamal($umur_pasien);
        $chipertext_jkel_pasien = $this->EnryptElgamal($jkel_pasien);
        $chipertext_nohp_pasien = $this->EnryptElgamal($nohp_pasien);

        Pasien::where('kode_pasien',$kode_pasien)->update([
            'nama_pasien' => $chipertext_nama_pasien,
            'kode_pasien' => $kode_pasien,
            'kategori_pasien' => $chipertext_kategori_pasien,
            'umur_pasien' => $chipertext_umur_pasien,
            'jkel_pasien' => $chipertext_jkel_pasien,
            'nohp_pasien' => $chipertext_nohp_pasien,
        ]);
       
        return redirect('data-pasien');
    }
}
