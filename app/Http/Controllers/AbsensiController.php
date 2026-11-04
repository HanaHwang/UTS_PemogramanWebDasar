<?php
namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class AbsensiController extends Controller{
    public function index(Request $request){
        $mataKuliahList = MataKuliah::all();
        $selectedDate = $request-&gt;input('tanggal', date('Y-m-d'));
        $selectedMkId = $request-&gt;input('mata_kuliah_id');

        $mahasiswa = Mahasiswa::all();

        $existingAbsensi = [];
        if ($selectedMkId &amp;&amp; $selectedDate){
            $existingAbsensi = Absensi::where('mata_kuliah_id', $selectedMkId)-&gt;where('tanggal', $selectedDate)-&gt;get()-&gt;keyBy('mahasiswa_id');
        }

        return view('absensi.index', compact(
            'mataKuliahList',
            'selectedDate',
            'selectedMkId',
            'mahasiswa',
            'existingAbsensi'
        ));
    }

    public function store(Request $request){
        $request-&gt;validate([
            'mata_kuliah_id' =&gt; 'required',
            'tanggal'        =&gt; 'required|date',
            'status'         =&gt; 'required|array',
        ]);

        foreach ($request-&gt;status as $mahasiswaId =&gt; $statusVal){
            Absensi::updateOrCreate(
                [
                    'mata_kuliah_id' =&gt; $request-&gt;mata_kuliah_id,
                    'mahasiswa_id'   =&gt; $mahasiswaId,
                    'tanggal'        =&gt; $request-&gt;tanggal,
                ],
                [
                    'status' =&gt; $statusVal,
                ]
            );
        }

        return redirect()-&gt;route('absensi.index', [
            'mata_kuliah_id' =&gt; $request-&gt;mata_kuliah_id,
            'tanggal'        =&gt; $request-&gt;tanggal,
        ])-&gt;with('success', 'Data absensi berhasil disimpan!');
    }
}
