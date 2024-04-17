<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\IzinResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Izin;

class IzinController extends Controller
{
    public function index()
    {
        $izins = Izin::with(['data_students' => function ($query) {
            $query->select('id', 'name');
        }, 'classstudents' => function ($query) {
            $query->select('id', 'name');
        },])
        ->select('id', 'data_students_id', 'classstudents_id','tanggal', 'status',  'description')
        ->when(request()->search, function($query) {
            $query->where('tanggal', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);

        return new IzinResource(true, 'List Data Izin', $izins);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data_students_id' => 'required',
            'classstudents_id' => 'required',
            'tanggal' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $izin = Izin::create([
            'data_students_id' => $request->data_students_id,
            'classstudents_id' => $request->classstudents_id,
            'tanggal' => $request->tanggal,
            'description' => $request->description,
        ]);

        if ($izin) {
            return new IzinResource(true, 'Data Izin Berhasil di Simpan!', $izin);
        }

        return new IzinResource(false, 'Data Izin Gagal di Simpan!', null);
    }

    public function show($id)
    {
        $izin = Izin::with(['data_students' => function ($query) {
            $query->select('id', 'name');
        }, 'classstudents' => function ($query) {
            $query->select('id', 'name');
        }, 'status' => function ($query) {
            $query->select('id', 'name');
        }])->select('id', 'data_students_id', 'classstudents_id','tanggal', 'status',  'description')->where('data_students_id', $id)->get();
        
        if ($izin) {
            return new IzinResource(true, 'Detail Data Izin!', $izin);
        }

        return new IzinResource(false, 'Detail Data Izin Tidak Ditemukan!', null);
    }

    public function update(Request $request, Izin $izin)
    {
        $validator = Validator::make($request->all(), [
            'data_students_id' => 'required',
            'classstudents_id' => 'required',
            'tanggal' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $izin->update([
            'data_students_id' => $request->data_students_id,
            'classstudents_id' => $request->classstudents_id,
            'tanggal' => $request->tanggal,
            'description' => $request->description,
        ]);

        if ($izin) {
            return new IzinResource(true, 'Data Izin Berhasil di Update', $izin);
        }

        return new IzinResource(false, 'Data  Izin Gagal di Update', null);
    }

    public function destroy($id)
    {
        $izin = Izin::find($id);

        if (!$izin) {
            return new IzinResource(false, 'Data Izin Tidak Ditemukan!', null);
        }

        if ($izin->delete()) {
            return new IzinResource(true, 'Data Izin Berhasil di Hapus!', null);
        }

        return new IzinResource(false, 'Data Izin Gagal di Hapus!', null);
    }

    public function all()
    {
        $izins = Izin::latest()->get();

        return new IzinResource(true, 'List Data Izin', $izins);
    }
    

    public function accept_izin($id)
{
    // Validasi bahwa ID izin yang diberikan benar
    $izin = Izin::find($id);
    if (!$izin) {
        return response()->json(['errors' => 'Izin tidak ditemukan.'], 404);
    }

    // Ubah status menjadi 'accepted'
    $izin->status = 'accepted';
    $izin->save();

    // Mengembalikan tanggapan JSON
    return response()->json(['message' => 'Izin telah diterima.'], 200);
}

public function rejected_izin($id)
{
    // Validasi bahwa ID izin yang diberikan benar
    $izin = Izin::find($id);
    if (!$izin) {
        return response()->json(['errors' => 'Izin tidak ditemukan.'], 404);
    }

    // Ubah status menjadi 'accepted'
    $izin->status = 'rejected';
    $izin->save();

    // Mengembalikan tanggapan JSON
    return response()->json(['message' => 'Izin telah diterima.'], 200);
}

}