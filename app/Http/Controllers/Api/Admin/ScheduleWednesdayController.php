<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleWednesdayResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\ScheduleWednesday;

class ScheduleWednesdayController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        // Get ScheduleWednesday
        $schedulewednesdays = ScheduleWednesday::with(['classstudents' => function ($query) {
            $query->select('id', 'name');
        }, 'subjects' => function ($query) {
            $query->select('id', 'name');
        }, 'data_teachers' => function ($query) {
            $query->select('id', 'name');
        }])->select('id', 'classstudents_id','subjects_id', 'data_teachers_id', 'start_time', 'end_time')
        ->when(request()->has('search'), function ($query) {
            $query->where('id', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);

        // Append query string to pagination links
        $schedulewednesdays->appends(['search' => request()->search]);

        // Return with Api Resource
        return new ScheduleWednesdayResource(true, 'List Data Jadwal Mata Pelajaran', $schedulewednesdays);
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
            'classstudents_id' => 'required',
            'subjects_id' => 'required',
            'data_teachers_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create ScheduleWednesday
        $schedulewednesday = ScheduleWednesday::create([
            'classstudents_id' => $request->classstudents_id,
            'subjects_id' => $request->subjects_id,
            'data_teachers_id' => $request->data_teachers_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        if ($schedulewednesday) {
            // Return success with Api Resource
            return new ScheduleWednesdayResource(true, 'Data Jadwal Mata Pelajaran Berhasil di Simpan!', $schedulewednesday);
        }

        // Return failed with Api Resource
        return new ScheduleWednesdayResource(false, 'Data Jadwal Mata Pelajaran Siswa Gagal di Simpan!', null);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedulewednesday = ScheduleWednesday::with([
            'classstudents' => function ($query) {
                $query->select('id', 'name');
            }, 'subjects' => function ($query) {
                $query->select('id', 'name');
            }, 'data_teachers' => function ($query) {
                $query->select('id', 'name');
            }])->select('id', 'classstudents_id','subjects_id', 'data_teachers_id', 'start_time', 'end_time')->where('classstudents_id', $id)->get();


        if ($schedulewednesday) {
            // Return success with Api Resource
            return new ScheduleWednesdayResource(true, 'Detail Data Jadwal Mata Pelajaran!', $schedulewednesday);
        }

        // Return failed with Api Resource
        return new ScheduleWednesdayResource(false, 'Detail Data Jadwal Mata Pelajaran Tidak Ditemukan!', null);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ScheduleWednesday $schedulewednesday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleWednesday $schedulewednesday)
    {
        /**
         * Validate request
         */
        $validator = Validator::make($request->all(), [
            'classstudents_id' => 'required',
            'subjects_id' => 'required',
            'data_teachers_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update ScheduleWednesday
        $schedulewednesday->update([
            'classstudents_id' => $request->classstudents_id,
            'subjects_id' => $request->subjects_id,
            'data_teachers_id' => $request->data_teachers_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        if ($schedulewednesday) {
            // Return success with Api Resource
            return new ScheduleWednesdayResource(true, 'Data Jadwal Mata Pelajaran Siswa Berhasil di Update', $schedulewednesday);
        }

        // Return failed with Api Resource
        return new ScheduleWednesdayResource(false, 'Data Jadwal Mata Pelajaran Siswa Gagal di Update', null);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find schedulewednesday by ID
        $schedulewednesday = ScheduleWednesday::find($id);

        if (!$schedulewednesday) {
            return new ScheduleWednesdayResource(false, 'Data Jadwal Mata Pelajaran Siswa Tidak Ditemukan!', null);
        }

        // Delete schedulewednesday
        if ($schedulewednesday->delete()) {
            // Return success with Api Resource
            return new ScheduleWednesdayResource(true, 'Data Jadwal Mata Pelajaran Siswa Berhasil di Hapus!', null);
        }

        // Return failed with Api Resource
        return new ScheduleWednesdayResource(false, 'Data Jadwal Mata Pelajaran Siswa Gagal di Hapus!', null);
    }


    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        // Get all ScheduleWednesday
        $schedulewednesday = ScheduleWednesday::latest()->get();

        // Return with Api Resource
        return new ScheduleWednesdayResource(true, 'List Data Jadwal Mata Pelajaran Siswa', $schedulewednesday);
    }
}
