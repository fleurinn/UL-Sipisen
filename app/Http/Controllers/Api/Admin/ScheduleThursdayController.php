<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleThursdayResource; // Ubah Resource yang sesuai
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\ScheduleThursday; // Ubah model yang sesuai

class ScheduleThursdayController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        // Get ScheduleThursday // Ubah nama model yang sesuai
        $schedulethursdays = ScheduleThursday::with(['subjects' => function ($query) {
            $query->select('id', 'name');
        }, 'data_teachers' => function ($query) {
            $query->select('id', 'name');
        }])->when(request()->has('search'), function ($query) {
            $query->where('id', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);

        // Append query string to pagination links
        $schedulethursdays->appends(['search' => request()->search]);

        // Return with Api Resource
        return new ScheduleThursdayResource(true, 'List Data Kehadiran Siswa', $schedulethursdays); // Ubah Resource yang sesuai
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
            'subjects_id' => 'required',
            'data_teachers_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create ScheduleThursday // Ubah nama model yang sesuai
        $schedulethursday = ScheduleThursday::create([
            'subjects_id' => $request->subjects_id,
            'data_teachers_id' => $request->data_teachers_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        if ($schedulethursday) {
            // Return success with Api Resource
            return new ScheduleThursdayResource(true, 'Data Kehadiran Siswa Berhasil di Simpan!', $schedulethursday); // Ubah Resource yang sesuai
        }

        // Return failed with Api Resource
        return new ScheduleThursdayResource(false, 'Data Kehadiran Siswa Gagal di Simpan!', null); // Ubah Resource yang sesuai
    }


    /**
     * show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedulethursday = ScheduleThursday::with([
            'subjects' => function ($query) {
                $query->select('id', 'name');
            }, 'data_teachers' => function ($query) {
                $query->select('id', 'name');
            }
        ])->find($id);

        if ($schedulethursday) {
            // Return success with Api Resource
            return new ScheduleThursdayResource(true, 'Detail Data Kehadiran!', $schedulethursday); // Ubah Resource yang sesuai
        }

        // Return failed with Api Resource
        return new ScheduleThursdayResource(false, 'Detail Data Kehadiran Tidak Ditemukan!', null); // Ubah Resource yang sesuai
    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleThursday $schedulethursday) // Ubah model yang sesuai
    {
        /**
         * Validate request
         */
        $validator = Validator::make($request->all(), [
            'subjects_id' => 'required',
            'data_teachers_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update ScheduleThursday // Ubah nama model yang sesuai
        $schedulethursday->update([
            'subjects_id' => $request->subjects_id,
            'data_teachers_id' => $request->data_teachers_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        if ($schedulethursday) {
            // Return success with Api Resource
            return new ScheduleThursdayResource(true, 'Data Kehadiran Siswa Berhasil di Update', $schedulethursday); // Ubah Resource yang sesuai
        }

        // Return failed with Api Resource
        return new ScheduleThursdayResource(false, 'Data Kehadiran Siswa Gagal di Update', null); // Ubah Resource yang sesuai
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find schedulethursday by ID // Ubah nama model yang sesuai
        $schedulethursday = ScheduleThursday::find($id); // Ubah nama model yang sesuai

        if (!$schedulethursday) {
            return new ScheduleThursdayResource(false, 'Data Kehadiran Siswa Tidak Ditemukan!', null); // Ubah Resource yang sesuai
        }

        // Delete schedulethursday
        if ($schedulethursday->delete()) {
            // Return success with Api Resource
            return new ScheduleThursdayResource(true, 'Data Kehadiran Siswa Berhasil di Hapus!', null); // Ubah Resource yang sesuai
        }

        // Return failed with Api Resource
        return new ScheduleThursdayResource(false, 'Data Kehadiran Siswa Gagal di Hapus!', null); // Ubah Resource yang sesuai
    }


    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        // //get ScheduleThursday // Ubah nama model yang sesuai
        $schedulethursday = ScheduleThursday::latest()->get(); // Ubah nama model yang sesuai

        //return with Api Resource
        return new ScheduleThursdayResource(true, 'List Data Kehadiran Kehadiran Siswa', $schedulethursday); // Ubah Resource yang sesuai
    }

}
