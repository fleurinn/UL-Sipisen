<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPiket;
use App\Http\Resources\JadwalPiketResource;
use Illuminate\Support\Facades\Validator;

class JadwalPiketController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil data jadwal piket
        $jadwalpikets = JadwalPiket::when(request()->search, function($jadwalpikets) {
            $jadwalpikets = $jadwalpikets->where('hari', 'like', '%'. request()->search . '&');
        })->latest()->paginate(5);

        // Menambahkan query string ke link pagination
        $jadwalpikets->appends(['search' => request()->search]);

        // Mengembalikan data dengan Api resource
        return new JadwalPiketResource(true, 'List Data Jadwal Piket', $jadwalpikets);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Validate request
         */
        $validator = Validator::make($request->all(), [
            'hari' => 'required',
            'nip' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create JadwalPiket
        $jadwalpiket = JadwalPiket::create([
            'hari' => $request->hari,
            'nip' => $request->nip,
            'name' => $request->name
        ]);

        if ($jadwalpiket) {
            // Return success with Api Resource
            return new JadwalPiketResource(true, 'Data Jadwal Piket Berhasil di Simpan!', $jadwalpiket);
        }

        // Return failed with Api Resource
        return new JadwalPiketResource(false, 'Data Jadwal Piket Gagal di Simpan!', null);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Mengambil jadwal piket
        $jadwalpiket = JadwalPiket::findOrFail($id);

        if($jadwalpiket) {
            // Mengembalikan keberhasilan dengan Api Resource
            return new JadwalPiketResource(true, 'Detail Data Jadwal Piket', $jadwalpiket);
        }

        // Mengembalikan kegagalan dengan Api Resource
        return new JadwalPiketResource(false, 'Data Jadwal Piket Tidak Ditemukan', null);
    }

    /**
 * Update the specified resource in storage.
 * 
 * @param \Illuminate\Http\Request $request
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, JadwalPiket $jadwalpiket)
{
    /**
     * Validate request
     */
    $validator = Validator::make($request->all(), [
        'hari' => 'required',
        'nip' => 'required',
        'name' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Update JadwalPiket
    $jadwalpiket->update([
        'hari' => $request->hari,
        'nip' => $request->nip,
        'name' => $request->name,
    ]);

    if ($jadwalpiket) {
        // Return success with Api Resource
        return new JadwalPiketResource(true, 'Data Jadwal Piket Berhasil di Update', $jadwalpiket);
    }

    // Return failed with Api Resource
    return new JadwalPiketResource(false, 'Data Jadwal Piket Gagal di Update', null);
}

/**
 * Remove the specified resource from storage.
 * 
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    // Find JadwalPiket by ID
    $jadwalpiket = JadwalPiket::findOrFail($id);

    // Delete JadwalPiket
    if ($jadwalpiket->delete()) {
        // Return success with Api Resource
        return new JadwalPiketResource(true, 'Data Jadwal Piket Berhasil di Hapus!', null);
    }

    // Return failed with Api Resource
    return new JadwalPiketResource(false, 'Data Jadwal Piket Gagal di Hapus!', null);
}



    /**
     * Get all JadwalPiket.
     * 
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        // Mengambil semua jadwal piket
        $jadwalpiket = JadwalPiket::latest()->get();

        // Mengembalikan data dengan Api Resource
        return new JadwalPiketResource(true, 'List Data Jadwal Piket', $jadwalpiket);
    }
}
