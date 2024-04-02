<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleFridayResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\ScheduleFriday;

class ScheduleFridayController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        // Get ScheduleFriday
        $schedulefridays = ScheduleFriday::with(['classstudents' => function ($query) {
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
        $schedulefridays->appends(['search' => request()->search]);

        // Return with Api Resource
        return new ScheduleFridayResource(true, 'List Data Jadwal Mata Pelajaran', $schedulefridays);
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

        // Create ScheduleFriday
        $schedulefriday = ScheduleFriday::create([
            'classstudents_id' => $request->classstudents_id,
            'subjects_id' => $request->subjects_id,
            'data_teachers_id' => $request->data_teachers_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        if ($schedulefriday) {
            // Return success with Api Resource
            return new ScheduleFridayResource(true, 'Data Jadwal Mata Pelajaran Berhasil di Simpan!', $schedulefriday);
        }

        // Return failed with Api Resource
        return new ScheduleFridayResource(false, 'Data Jadwal Mata Pelajaran Siswa Gagal di Simpan!', null);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedulefriday = ScheduleFriday::with([
            'classstudents' => function ($query) {
                $query->select('id', 'name');
            }, 'subjects' => function ($query) {
                $query->select('id', 'name');
            }, 'data_teachers' => function ($query) {
                $query->select('id', 'name');
            }])->select('id', 'classstudents_id','subjects_id', 'data_teachers_id', 'start_time', 'end_time')->where('classstudents_id', $id)->get();


        if ($schedulefriday) {
            // Return success with Api Resource
            return new ScheduleFridayResource(true, 'Detail Data Jadwal Mata Pelajaran!', $schedulefriday);
        }

        // Return failed with Api Resource
        return new ScheduleFridayResource(false, 'Detail Data Jadwal Mata Pelajaran Tidak Ditemukan!', null);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ScheduleFriday $schedulefriday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleFriday $schedulefriday)
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

        // Update ScheduleFriday
        $schedulefriday->update([
            'classstudents_id' => $request->classstudents_id,
            'subjects_id' => $request->subjects_id,
            'data_teachers_id' => $request->data_teachers_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        if ($schedulefriday) {
            // Return success with Api Resource
            return new ScheduleFridayResource(true, 'Data Jadwal Mata Pelajaran Siswa Berhasil di Update', $schedulefriday);
        }

        // Return failed with Api Resource
        return new ScheduleFridayResource(false, 'Data Jadwal Mata Pelajaran Siswa Gagal di Update', null);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find schedulefriday by ID
        $schedulefriday = ScheduleFriday::find($id);

        if (!$schedulefriday) {
            return new ScheduleFridayResource(false, 'Data Jadwal Mata Pelajaran Siswa Tidak Ditemukan!', null);
        }

        // Delete schedulefriday
        if ($schedulefriday->delete()) {
            // Return success with Api Resource
            return new ScheduleFridayResource(true, 'Data Jadwal Mata Pelajaran Siswa Berhasil di Hapus!', null);
        }

        // Return failed with Api Resource
        return new ScheduleFridayResource(false, 'Data Jadwal Mata Pelajaran Siswa Gagal di Hapus!', null);
    }


    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        // Get all ScheduleFriday
        $schedulefriday = ScheduleFriday::latest()->get();

        // Return with Api Resource
        return new ScheduleFridayResource(true, 'List Data Jadwal Mata Pelajaran Siswa', $schedulefriday);
    }
}
