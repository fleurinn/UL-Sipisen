<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleMondayResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\ScheduleMonday;

class ScheduleMondayController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        // Get ScheduleMonday
        $schedulemondays = ScheduleMonday::with(['subjects' => function ($query) {
            $query->select('id', 'name');
        }, 'data_teachers' => function ($query) {
            $query->select('id', 'name');
        }])->when(request()->has('search'), function ($query) {
            $query->where('id', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);
        

        // Append query string to pagination links
        $schedulemondays->appends(['search' => request()->search]);

        // Return with Api Resource
        return new ScheduleMondayResource(true, 'List Data Kehadiran Siswa', $schedulemondays);
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

        // Create ScheduleMonday
        $schedulemonday = ScheduleMonday::create([
            'subjects_id' => $request->subjects_id,
            'data_teachers_id' => $request->data_teachers_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        if ($schedulemonday) {
            // Return success with Api Resource
            return new ScheduleMondayResource(true, 'Data Kehadiran Siswa Berhasil di Simpan!', $schedulemonday);
        }

        // Return failed with Api Resource
        return new ScheduleMondayResource(false, 'Data Kehadiran Siswa Gagal di Simpan!', null);
    }

    /**
     * show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedulemonday = ScheduleMonday::with([
            'subjects' => function ($query) {
                $query->select('id', 'name');
            }, 'data_teachers' => function ($query) {
                $query->select('id', 'name');
            }
        ])->find($id);

        if ($schedulemonday) {
            // Return success with Api Resource
            return new ScheduleMondayResource(true, 'Detail Data Kehadiran!', $schedulemonday);
        }

        // Return failed with Api Resource
        return new ScheduleMondayResource(false, 'Detail Data Kehadiran Tidak Ditemukan!', null);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleMonday $schedulemonday)
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

        // Update schedulemonday
        $schedulemonday->update([
            'subjects_id' => $request->subjects_id,
            'data_teachers_id' => $request->data_teachers_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        if ($schedulemonday) {
            // Return success with Api Resource
            return new ScheduleMondayResource(true, 'Data Kehadiran Siswa Berhasil di Update', $schedulemonday);
        }

        // Return failed with Api Resource
        return new ScheduleMondayResource(false, 'Data  Kehadiran Siswa Gagal di Update', null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find schedulemonday by ID
        $schedulemonday = ScheduleMonday::find($id);

        if (!$schedulemonday) {
            return new ScheduleMondayResource(false, 'Data Kehadiran Siswa Tidak Ditemukan!', null);
        }

        // Delete schedulemonday
        if ($schedulemonday->delete()) {
            // Return success with Api Resource
            return new ScheduleMondayResource(true, 'Data Kehadiran Siswa Berhasil di Hapus!', null);
        }

        // Return failed with Api Resource
        return new ScheduleMondayResource(false, 'Data Kehadiran Siswa Gagal di Hapus!', null);
    }

    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        // //get ScheduleMonday
        $schedulemonday = ScheduleMonday::latest()->get();

        //return with Api Resource
        return new ScheduleMondayResource(true, 'List Data Kehadiran Kehadiran Siswa', $schedulemonday);
    }
}
