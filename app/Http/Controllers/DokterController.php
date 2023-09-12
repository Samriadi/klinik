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

    public function edit($id)
    {
        $dokter = Dokter::where('id_dokter', $id)->first();
        $id_dokter = $dokter->id_dokter;
        $nama_dokter = $dokter->nama_dokter;
        $nip_dokter = $dokter->nip_dokter;
        $nohp_dokter = $dokter->nohp_dokter;
        $foto_dokter = $dokter->foto_dokter;

        return view('pages.dokter.edit', [ 'type_menu' => ''], [
            'id' => $id_dokter,
            'nama' => $nama_dokter,
            'nip' => $nip_dokter,
            'nohp' => $nohp_dokter,
            'foto' => $foto_dokter,
        
        ]);
    }
    public function update(Request $request)
    {
        $id_dokter = $request->id_dokter;
        $nama_dokter = $request->nama_dokter;
        $nip_dokter = $request->nip_dokter;
        $nohp_dokter = $request->nohp_dokter;


        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        // ]);

        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('images', 'public');
        // }
        
        Dokter::where('id_dokter',$id_dokter)->update([
            'nama_dokter' => $nama_dokter,
            'nip_dokter' => $nip_dokter,
            'nohp_dokter' => $nohp_dokter,
        ]);

        return redirect('data-dokter'); 

    }
    public function hapus($id)
    {
        Dokter::where('id_dokter',$id)->delete();
            
        return redirect('data-dokter');
    }
}
