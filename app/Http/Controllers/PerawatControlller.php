<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perawat;
use Illuminate\Support\Facades\Log;
class PerawatControlller extends Controller
{
    public function index()
    {
        $perawat = Perawat::all(); // Retrieve all from the database
        return view('pages.perawat.index', ['perawat' => $perawat , 'type_menu' => '']);
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
    
    // dd($imagePath);

    $model = new Perawat;
    $model->nama_perawat = $request->input('nama_perawat');
    $model->nip_perawat = $request->input('nip_perawat');
    $model->nohp_perawat = $request->input('nohp_perawat');
    $model->foto_perawat = $imagePath; 
    $model->save();

    return redirect('data-perawat');
    }
    
    public function tambah()
    {
        return view('pages.perawat.tambah', [ 'type_menu' => '']);
    }

    public function edit($id)
    {
        $perawat = Perawat::where('id_perawat', $id)->get();  
        return view('pages.perawat.edit', [ 'type_menu' => ''], ['perawat' => $perawat]);
    }
    public function update(Request $request)
    {
        // dd($request);
        // dd($request->id_perawat);
        $id_perawat = $request->id_perawat;
        $nama_perawat = $request->nama_perawat;
        $nip_perawat = $request->nip_perawat;
        $nohp_perawat = $request->nohp_perawat;

        // dd($nama_perawat);
        $request->validate
        ([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', 
        ]);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Perawat::where('id_perawat',$id_perawat)->update([
            'nama_perawat' => $nama_perawat,
            'nip_perawat' => $nip_perawat,
            'nohp_perawat' => $nohp_perawat,
        ]);
        
        return redirect('data-perawat'); 

    }
    public function hapus($id)
    {
        Perawat::where('id_perawat',$id)->delete();
            
        return redirect('data-perawat');
    }
}
