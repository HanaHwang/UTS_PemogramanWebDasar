<?php

namespace App\Http\Controllers;

use App/Models/MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller{
    public function index(){
        $mataKuliah = MataKuliah::all();
        return view('mata_kuliah.index', compact('mataKuliah'));
    }

    public function create(){
        return view('mata_kuliah.create');
    }

    public function store(Request $request){
        $request-&gt;validate([
            'kode' =&gt; 'required|unique:mata_kuliahs,kode',
            'nama' =&gt; 'required',
            'sks'  =&gt; 'required|numeric',
        ]);
        MataKuliah::create($request-&gt;all());
        return redirect()-&gt;route('mata-kuliah.index')-&gt;with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(MataKuliah $mataKuliah){
        return view('mata_kuliah.edit', compact('mataKuliah'));
    }

    public function update(Request $request, MataKuliah $mataKuliah){
        $request-&gt;validate([
            'kode' =&gt; 'required|unique:mata_kuliahs,kode,' . $mataKuliah-&gt;id,
            'nama' =&gt; 'required',
            'sks'  =&gt; 'required|numeric',
        ]);
        $mataKuliah-&gt;update($request-&gt;all());
        return redirect()-&gt;route('mata-kuliah.index')-&gt;with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah){
        $mataKuliah-&gt;delete();
        return redirect()-&gt;route('mata-kuliah.index')-&gt;with('success', 'Mata kuliah berhasil dihapus.');
    }
}
