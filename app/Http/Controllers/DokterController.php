<?php

namespace App\Http\Controllers;
use App\Models\Dokter;

use Illuminate\Http\Request;

class DokterController extends Controller
{
    //
    public function index()
    {
        $dokter = Dokter::all(); // Retrieve all from the database
        return view('pages.dokter.index', ['dokter' => $dokter , 'type_menu' => '']);
    }

    public function store(Request $request)
    {
    $request->validate
    ([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif', 
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    }
    
    // // dd($imagePath);

    $model = new Dokter();
    $model->nama_dokter = $request->input('nama_dokter');
    $model->nip_dokter = $request->input('nip_dokter');
    $model->nohp_dokter = $request->input('nohp_dokter');
    $model->foto_dokter = $imagePath; 
    $model->save();

    return redirect('data-dokter');
    }
    
    public function tambah()
    {
        return view('pages.dokter.tambah', [ 'type_menu' => '']);
    }

    // public function edit($id)
    // {
    //     $perawat = Perawat::where('id_perawat', $id)->get();  
    //     return view('pages.perawat.edit', [ 'type_menu' => ''], ['perawat' => $perawat]);
    // }
    // public function update(Request $request)
    // {
    //     // dd($request);
    //     // dd($request->id_perawat);
    //     $id_perawat = $request->id_perawat;
    //     $nama_perawat = $request->nama_perawat;
    //     $nip_perawat = $request->nip_perawat;
    //     $nohp_perawat = $request->nohp_perawat;

    //     // dd($nama_perawat);
    //     // $request->validate
    //     // ([
    //     //     'image' => 'required|image|mimes:jpeg,png,jpg,gif', 
    //     // ]);
    
    //     // if ($request->hasFile('image')) {
    //     //     $imagePath = $request->file('image')->store('images', 'public');
    //     // }

    //     Perawat::where('id_perawat',$id_perawat)->update([
    //         'nama_perawat' => $nama_perawat,
    //         'nip_perawat' => $nip_perawat,
    //         'nohp_perawat' => $nohp_perawat,
    //     ]);
        
    //     return redirect('data-perawat'); 

    // }
    public function hapus($id)
    {
        Dokter::where('id_dokter',$id)->delete();
            
        return redirect('data-dokter');
    }
}
