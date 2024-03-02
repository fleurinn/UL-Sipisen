<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleWednesdayResource; // Ubah Resource yang sesuai
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\ScheduleWednesday; // Ubah model yang sesuai

class ScheduleWednesdayController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        // Get ScheduleWednesday // Ubah nama model yang sesuai
        $schedulewednesdays = ScheduleWednesday::with(['subjects' => function ($query) {
            $query->select('id', 'name');
        }, 'data_teachers' => function ($query) {
            $query->select('id', 'name');
        }])->when(request()->has('search'), function ($query) {
            $query->where('id', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);

        // Append query string to pagination links
        $schedulewednesdays->appends(['search' => request()->search]);

        // Return with Api Resource
        return new ScheduleWednesdayResource(true, 'List Data Kehadiran Siswa', $schedulewednesdays); // Ubah Resource yang sesuai
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

        // Create ScheduleWednesday // Ubah nama model yang sesuai
        $schedulewednesday = ScheduleWednesday::create([
            'subjects_id' => $request->subjects_id,
            'data_teachers_id' => $request->data_teachers_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        if ($schedulewednesday) {
            // Return success with Api Resource
            return new ScheduleWednesdayResource(true, 'Data Kehadiran Siswa Berhasil di Simpan!', $schedulewednesday); // Ubah Resource yang sesuai
        }

        // Return failed with Api Resource
        return new ScheduleWednesdayResource(false, 'Data Kehadiran Siswa Gagal di Simpan!', null); // Ubah Resource yang sesuai
    }


    /**
     * show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedulewednesday = ScheduleWednesday::with([
            'subjects' => function ($query) {
                $query->select('id', 'name');
            }, 'data_teachers' => function ($query) {
                $query->select('id', 'name');
            }
        ])->find($id);

        if ($schedulewednesday) {
            // Return success with Api Resource
            return new ScheduleWednesdayResource(true, 'Detail Data Kehadiran!', $schedulewednesday); // Ubah Resource yang sesuai
        }

        // Return failed with Api Resource
        return new ScheduleWednesdayResource(false, 'Detail Data Kehadiran Tidak Ditemukan!', null); // Ubah Resource yang sesuai
    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleWednesday $schedulewednesday) // Ubah model yang sesuai
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

        // Update ScheduleWednesday // Ubah nama model yang sesuai
        $schedulewednesday->update([
            'subjects_id' => $request->subjects_id,
            'data_teachers_id' => $request->data_teachers_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        if ($schedulewednesday) {
            // Return success with Api Resource
            return new ScheduleWednesdayResource(true, 'Data Kehadiran Siswa Berhasil di Update', $schedulewednesday); // Ubah Resource yang sesuai
        }

        // Return failed with Api Resource
        return new ScheduleWednesdayResource(false, 'Data Kehadiran Siswa Gagal di Update', null); // Ubah Resource yang sesuai
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find schedulewednesday by ID // Ubah nama model yang sesuai
        $schedulewednesday = ScheduleWednesday::find($id); // Ubah nama model yang sesuai

        if (!$schedulewednesday) {
            return new ScheduleWednesdayResource(false, 'Data Kehadiran Siswa Tidak Ditemukan!', null); // Ubah Resource yang sesuai
        }

        // Delete schedulewednesday
        if ($schedulewednesday->delete()) {
            // Return success with Api Resource
            return new ScheduleWednesdayResource(true, 'Data Kehadiran Siswa Berhasil di Hapus!', null); // Ubah Resource yang sesuai
        }

        // Return failed with Api Resource
        return new ScheduleWednesdayResource(false, 'Data Kehadiran Siswa Gagal di Hapus!', null); // Ubah Resource yang sesuai
    }


    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        // //get ScheduleWednesday // Ubah nama model yang sesuai
        $schedulewednesday = ScheduleWednesday::latest()->get(); // Ubah nama model yang sesuai

        //return with Api Resource
        return new ScheduleWednesdayResource(true, 'List Data Kehadiran Kehadiran Siswa', $schedulewednesday); // Ubah Resource yang sesuai
    }

}
