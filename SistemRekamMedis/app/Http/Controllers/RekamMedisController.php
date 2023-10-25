<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    //Displays data
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get 10 latest posts
        //$Data = CharData::all();
        $Data = DB::table('rekam_medis')->latest()->paginate(10);
        $Id_Pasien = DB::table('pasiens')->latest()->select('id', 'nama_lengkap')->get();
        $Id_Dokter = DB::table(table: 'dokters')->latest()->select('id', 'nama_lengkap')->get();

        //render view with posts
        return view('RekamMedis.index', ['RekamMedis' => $Data, 'Id_Pasien' => $Id_Pasien, 'Id_Dokter' => $Id_Dokter]);
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        $Id_Pasien = DB::table('pasiens')->latest()->select('id', 'nama_lengkap')->get();
        $Id_Dokter = DB::table(table: 'dokters')->latest()->select('id', 'nama_lengkap')->get();
        //Directs to resources/views/CharData/create.blade.php
        return view('RekamMedis.create', compact('Id_Pasien', 'Id_Dokter'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'pasiens_id' => 'required|exists:pasiens,id',
            'dokters_id' => 'required|exists:dokters,id',
            'kondisi'=> 'required',
            'suhu' => 'required|decimal:0,2|between:35,45.5',
            'file_resep'     => 'required|mimes:jpeg,jpg,png,pdf',
        ]);

        //upload image
        $file = $request->file('file_resep');
        $file->storeAs('public/FileResep', $file->hashName());

        //create post
        RekamMedis::create([
            'pasiens_id' => $request->pasiens_id,
            'dokters_id' => $request->dokters_id,
            'kondisi'=> $request->kondisi,
            'suhu' => $request->suhu,
            'file_resep'     => $file->hashName(),
        ]);

        //redirect to index
        return redirect()->route('RekamMedis.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
