<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riwayat;

class RiwayatController extends Controller
{
    public function index()
    {
        $record = Riwayat::all();
        return view('pages.riwayat.index', ['riwayat' => $record , 'type_menu' => '']);
    }

    public function tambah(){
        return view('pages.riwayat.tambah', [ 'type_menu' => '']);
    }

    public function store(Request $request)
    {
        $identitas_pasien = $request->input('identitas_pasien');
        $tanggal_berobat = $request->input('tanggal_berobat');
        $gejala_pasien = $request->input('gejala_pasien');
        $obat_pasien = $request->input('obat_pasien');
        $perawat = $request->input('perawat');
        $dokter = $request->input('dokter');

        $ascii_identitas_pasien = $this->stringToAscii($identitas_pasien);
        $ascii_tanggal_berobat = $this->stringToAscii($tanggal_berobat);
        $ascii_gejala_pasien = $this->stringToAscii($gejala_pasien);
        $ascii_obat_pasien = $this->stringToAscii($obat_pasien);
        $ascii_perawat = $this->stringToAscii($perawat);
        $ascii_dokter = $this->stringToAscii($dokter);

        $modulo_identitas_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_identitas_pasien);
        $modulo_tanggal_berobat = array_map(function ($item) { return $item**7%403; }, $ascii_tanggal_berobat);
        $modulo_gejala_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_gejala_pasien);
        $modulo_obat_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_obat_pasien);
        $modulo_perawat = array_map(function ($item) { return $item**7%403; }, $ascii_perawat);
        $modulo_dokter = array_map(function ($item) { return $item**7%403; }, $ascii_dokter);
        
        $str_identitas_pasien = implode(" ", $modulo_identitas_pasien);
        $str_tanggal_berobat = implode(" ", $modulo_tanggal_berobat);
        $str_gejala_pasien = implode(" ", $modulo_gejala_pasien);
        $str_obat_pasien = implode(" ", $modulo_obat_pasien);
        $str_perawat = implode(" ", $modulo_perawat);
        $str_dokter = implode(" ", $modulo_dokter);

        // insert data ke table 
         Riwayat::insert([
            'identitas_pasien' => $str_identitas_pasien,
            'tanggal_berobat' => $tanggal_berobat,
            'gejala_pasien' => $str_gejala_pasien,
            'obat_pasien' => $str_obat_pasien,
            'perawat' => $perawat,
            'dokter' => $dokter,
        ]);
        // alihkan halaman ke halaman 
        return redirect('data-riwayat');
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
        $record = Riwayat::where('id_riwayat', $id)->get();
        $identitas_pasien = $record->pluck('identitas_pasien');
        $tanggal_berobat = $record->pluck('tanggal_berobat');
        $gejala_pasien = $record->pluck('gejala_pasien');
        $obat_pasien = $record->pluck('obat_pasien');
        $perawat = $record->pluck('perawat');
        $dokter = $record->pluck('dokter');

        $powerPow = 103;
        $powerMod = 403;

        //convert to array
        $arr_identitas_pasien = $identitas_pasien->toArray();
        $arr_gejala_pasien = $gejala_pasien->toArray();
        $arr_obat_pasien = $obat_pasien->toArray();
        $arr_perawat = $perawat->toArray();
        $arr_dokter = $dokter->toArray();
       
        //convert string array to numeric array
        $str_identitas_pasien = implode(" ", $arr_identitas_pasien);  $int_identitas_pasien = explode(" ", $str_identitas_pasien);
        $str_gejala_pasien = implode(" ", $arr_gejala_pasien);  $int_gejala_pasien = explode(" ", $str_gejala_pasien);
        $str_obat_pasien = implode(" ", $arr_obat_pasien);  $int_obat_pasien = explode(" ", $str_obat_pasien);
        $str_perawat = implode(" ", $arr_perawat);  
        $str_dokter = implode(" ", $arr_dokter);  
     
        //convert integer to array
        $int_arr_identitas_pasien = array_map('intval', $int_identitas_pasien);
        $int_arr_gejala_pasien = array_map('intval', $int_gejala_pasien);
        $int_arr_obat_pasien = array_map('intval', $int_obat_pasien);
  
       
        //handle pow
        $pow_identitas_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_identitas_pasien);
        // $pow_kode_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        // }, $int_arr_kode_pasien);
        $pow_gejala_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_gejala_pasien);
        $pow_obat_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_obat_pasien);

        //handle mod
        $modulo_identitas_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_identitas_pasien);
        // $modulo_kode_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        // }, $pow_kode_pasien);
        $modulo_gejala_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_gejala_pasien);
        $modulo_obat_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_obat_pasien);

        //convert to ascii
        $ascii_identitas_pasien = array_map('chr', $modulo_identitas_pasien);
        $ascii_gejala_pasien = array_map('chr', $modulo_gejala_pasien);
        $ascii_obat_pasien = array_map('chr', $modulo_obat_pasien);

        //descipt
        $desc_identitas_pasien= implode($ascii_identitas_pasien);
        $desc_gejala_pasien = implode($ascii_gejala_pasien);
        $desc_obat_pasien = implode($ascii_obat_pasien);

        return view('pages.riwayat.desc', [
            'identitas_pasien' => $desc_identitas_pasien,
            'gejala_pasien' => $desc_gejala_pasien,
            'obat_pasien' => $desc_obat_pasien,
            'perawat' => $str_perawat,
            'dokter' => $str_dokter,
        ], [ 'type_menu' => '']);

    }
    
    function customPowerPow($number, $power) {
        return bcpow($number, $power);
    }
    
    function customPowerMod($number, $power) {
        return bcmod($number, $power);
    }

    public function edit($id)
    {
        $record = Riwayat::where('id_riwayat', $id)->get();  
        $id_riwayat = $record->pluck('id_riwayat');
        $identitas_pasien = $record->pluck('identitas_pasien');
        $tanggal_berobat = $record->pluck('tanggal_berobat');
        $gejala_pasien = $record->pluck('gejala_pasien');
        $obat_pasien = $record->pluck('obat_pasien');
        $perawat = $record->pluck('perawat');
        $dokter = $record->pluck('dokter');

        $powerPow = 103;
        $powerMod = 403;

        //convert to array
        $arr_id_riwayat = $id_riwayat->toArray();
        $arr_identitas_pasien = $identitas_pasien->toArray();
        $arr_gejala_pasien = $gejala_pasien->toArray();
        $arr_obat_pasien = $obat_pasien->toArray();
        $arr_perawat = $perawat->toArray();
        $arr_dokter = $dokter->toArray();
       
        //convert string array to numeric array
        $str_identitas_pasien = implode(" ", $arr_identitas_pasien);  
        $int_identitas_pasien = explode(" ", $str_identitas_pasien);

        $str_gejala_pasien = implode(" ", $arr_gejala_pasien);  
        $int_gejala_pasien = explode(" ", $str_gejala_pasien);

        $str_obat_pasien = implode(" ", $arr_obat_pasien);  
        $int_obat_pasien = explode(" ", $str_obat_pasien);

        $str_id_riwayat = implode(" ", $arr_id_riwayat);  
        $str_perawat = implode(" ", $arr_perawat);  
        $str_dokter = implode(" ", $arr_dokter);  

     
        //convert integer to array
        $int_arr_identitas_pasien = array_map('intval', $int_identitas_pasien);
        $int_arr_gejala_pasien = array_map('intval', $int_gejala_pasien);
        $int_arr_obat_pasien = array_map('intval', $int_obat_pasien);
       
        //handle pow
        $pow_identitas_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_identitas_pasien);
        $pow_gejala_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_gejala_pasien);
        $pow_obat_pasien  = array_map(function($num) use ($powerPow) {return $this->customPowerPow($num, $powerPow); 
        }, $int_arr_obat_pasien);

        //handle mod
        $modulo_identitas_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_identitas_pasien);
        $modulo_gejala_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_gejala_pasien);
        $modulo_obat_pasien  = array_map(function($num) use ($powerMod) {return $this->customPowerMod($num, $powerMod);
        }, $pow_obat_pasien);

        //convert to ascii
        $ascii_identitas_pasien = array_map('chr', $modulo_identitas_pasien);
        $ascii_gejala_pasien = array_map('chr', $modulo_gejala_pasien);
        $ascii_obat_pasien = array_map('chr', $modulo_obat_pasien);


        //descipt
        $desc_identitas_pasien = implode($ascii_identitas_pasien);
        $desc_gejala_pasien = implode($ascii_gejala_pasien);
        $desc_obat_pasien = implode($ascii_obat_pasien);
 
        // dd($tanggal_berobat);
        // passing data pasien yang didapat ke view edit.blade.php
        return view('pages.riwayat.edit', [
            'type_menu' => '', 
            'id_riwayat' => $str_id_riwayat,
            'identitas_pasien' => $desc_identitas_pasien,
            'gejala_pasien' => $desc_gejala_pasien,
            'obat_pasien' => $desc_obat_pasien,
            'tanggal_berobat' => $tanggal_berobat,
            'perawat' => $str_perawat,
            'dokter' => $str_dokter,
        ]);
    
    }

    public function update(Request $request)
    {
        $id_riwayat = $request->id_riwayat;
        $identitas_pasien = $request->identitas_pasien;

        $gejala_pasien = $request->gejala_pasien;
        $obat_pasien = $request->obat_pasien;
        $tanggal_berobat = $request->tanggal_berobat;
        $perawat = $request->perawat;
        $dokter = $request->dokter;
        
        $ascii_idenetitas_pasien = $this->stringToAscii($identitas_pasien);
        $ascii_gejala_pasien = $this->stringToAscii($gejala_pasien);
        $ascii_obat_pasien = $this->stringToAscii($obat_pasien);


        $modulo_identitas_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_idenetitas_pasien);
        $modulo_gejala_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_gejala_pasien);
        $modulo_obat_pasien = array_map(function ($item) { return $item**7%403; }, $ascii_obat_pasien);


        $str_identitas_pasien = implode(" ", $modulo_identitas_pasien);
        $str_gejala_pasien = implode(" ", $modulo_gejala_pasien);
        $str_obat_pasien = implode(" ", $modulo_obat_pasien);
      
        // dd($id_riwayat, $str_identitas_pasien, $str_gejala_pasien, $str_obat_pasien, $perawat, $dokter);

        Riwayat::where('id_riwayat',$id_riwayat)->update([
            'identitas_pasien' => $str_identitas_pasien,
            'gejala_pasien' => $str_gejala_pasien,
            'obat_pasien' => $str_obat_pasien,
            'perawat' => $perawat,
            'dokter' => $dokter,
        ]);
        
       
        return redirect('data-riwayat');
    }

    public function hapus($id)
    {
        Riwayat::where('id_riwayat',$id)->delete();
            
        return redirect('data-riwayat');
    }
}
