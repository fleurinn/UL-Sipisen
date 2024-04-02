<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleTuesdayResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\ScheduleTuesday;

class ScheduleTuesdayController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        // Get ScheduleTuesday
        $scheduletuesdays = ScheduleTuesday::with(['classstudents' => function ($query) {
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
        $scheduletuesdays->appends(['search' => request()->search]);

        // Return with Api Resource
        return new ScheduleTuesdayResource(true, 'List Data Jadwal Mata Pelajaran', $scheduletuesdays);
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

        // Create ScheduleTuesday
        $scheduletuesday = ScheduleTuesday::create([
            'classstudents_id' => $request->classstudents_id,
            'subjects_id' => $request->subjects_id,
            'data_teachers_id' => $request->data_teachers_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        if ($scheduletuesday) {
            // Return success with Api Resource
            return new ScheduleTuesdayResource(true, 'Data Jadwal Mata Pelajaran Berhasil di Simpan!', $scheduletuesday);
        }

        // Return failed with Api Resource
        return new ScheduleTuesdayResource(false, 'Data Jadwal Mata Pelajaran Siswa Gagal di Simpan!', null);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $scheduletuesday = ScheduleTuesday::with([
            'classstudents' => function ($query) {
                $query->select('id', 'name');
            }, 'subjects' => function ($query) {
                $query->select('id', 'name');
            }, 'data_teachers' => function ($query) {
                $query->select('id', 'name');
            }])->select('id', 'classstudents_id','subjects_id', 'data_teachers_id', 'start_time', 'end_time')->where('classstudents_id', $id)->get();


        if ($scheduletuesday) {
            // Return success with Api Resource
            return new ScheduleTuesdayResource(true, 'Detail Data Jadwal Mata Pelajaran!', $scheduletuesday);
        }

        // Return failed with Api Resource
        return new ScheduleTuesdayResource(false, 'Detail Data Jadwal Mata Pelajaran Tidak Ditemukan!', null);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ScheduleTuesday $scheduletuesday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleTuesday $scheduletuesday)
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

        // Update ScheduleTuesday
        $scheduletuesday->update([
            'classstudents_id' => $request->classstudents_id,
            'subjects_id' => $request->subjects_id,
            'data_teachers_id' => $request->data_teachers_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        if ($scheduletuesday) {
            // Return success with Api Resource
            return new ScheduleTuesdayResource(true, 'Data Jadwal Mata Pelajaran Siswa Berhasil di Update', $scheduletuesday);
        }

        // Return failed with Api Resource
        return new ScheduleTuesdayResource(false, 'Data Jadwal Mata Pelajaran Siswa Gagal di Update', null);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find scheduletuesday by ID
        $scheduletuesday = ScheduleTuesday::find($id);

        if (!$scheduletuesday) {
            return new ScheduleTuesdayResource(false, 'Data Jadwal Mata Pelajaran Siswa Tidak Ditemukan!', null);
        }

        // Delete scheduletuesday
        if ($scheduletuesday->delete()) {
            // Return success with Api Resource
            return new ScheduleTuesdayResource(true, 'Data Jadwal Mata Pelajaran Siswa Berhasil di Hapus!', null);
        }

        // Return failed with Api Resource
        return new ScheduleTuesdayResource(false, 'Data Jadwal Mata Pelajaran Siswa Gagal di Hapus!', null);
    }


    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        // Get all ScheduleTuesday
        $scheduletuesday = ScheduleTuesday::latest()->get();

        // Return with Api Resource
        return new ScheduleTuesdayResource(true, 'List Data Jadwal Mata Pelajaran Siswa', $scheduletuesday);
    }
}
