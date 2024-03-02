<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource; // Mengubah Resource yang sesuai
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Schedule; // Mengubah model yang sesuai

class ScheduleController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        // Dapatkan Schedule
        $schedules = Schedule::with([
            'majors' => function ($query) {
                $query->select('id', 'name');
            }, 
            'classstudents' => function ($query) {
                $query->select('id', 'name');
            },  
            'schedule_mondays.subjects',
            'schedule_mondays.data_teachers', 
            'schedule_tuesdays.subjects',
            'schedule_tuesdays.data_teachers',
            'schedule_wednesdays.subjects', 
            'schedule_wednesdays.data_teachers',
            'schedule_thursdays.subjects',
            'schedule_thursdays.data_teachers',
            'schedule_fridays.subjects',
            'schedule_fridays.data_teachers',
        ])->when(request()->has('search'), function ($query) {
            $query->where('classstudents_id', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);
                

        // Tambahkan query string ke pagination links
        $schedules->appends(['search' => request()->search]);

        // Return dengan Api Resource
        return new ScheduleResource(true, 'List Data Jadwal Mata Pelajaran', $schedules);
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
            'majors_id' => 'required',
            'classstudents_id' => 'required',
            'schedule_mondays_id' => 'required',
            'schedule_tuesdays_id' => 'required',
            'schedule_wednesdays_id' => 'required',
            'schedule_thursdays_id' => 'required',
            'schedule_fridays_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create Schedule
        $schedule = Schedule::create([
            'majors_id' => $request->majors_id,
            'classstudents_id' => $request->classstudents_id,
            'schedule_mondays_id' => $request->schedule_mondays_id,
            'schedule_tuesdays_id' => $request->schedule_tuesdays_id,
            'schedule_wednesdays_id' => $request->schedule_wednesdays_id,
            'schedule_thursdays_id' => $request->schedule_thursdays_id,
            'schedule_fridays_id' => $request->schedule_fridays_id,
        ]);

        if ($schedule) {
            // Return success with Api Resource
            return new ScheduleResource(true, 'Data Jadwal Mata Pelajaran Berhasil di Simpan!', $schedule);
        }

        // Return failed with Api Resource
        return new ScheduleResource(false, 'Data Jadwal Mata Pelajaran Gagal di Simpan!', null);
    }
    
    /**
     * show the form for editing the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::with([
            'majors' => function ($query) {
                $query->select('id', 'name');
            },
            'classstudents' => function ($query) {
                $query->select('id', 'name');
            }, 
            'schedule_mondays.subjects',
            'schedule_mondays.data_teachers', 
            'schedule_tuesdays.subjects',
            'schedule_tuesdays.data_teachers',
            'schedule_wednesdays.subjects', 
            'schedule_wednesdays.data_teachers',
            'schedule_thursdays.subjects',
            'schedule_thursdays.data_teachers',
            'schedule_fridays.subjects',
            'schedule_fridays.data_teachers',
        ])->where('classstudents_id', $id)->get();

        if($schedule) {
            // Return success with Api Resource
            return new ScheduleResource(true, 'Detail Data Jadwal Mata Pelajaran!', $schedule);
        }
        
        // Return failed with Api Resource
        return new ScheduleResource(false, 'Detail Data Jadwal Mata Pelajaran Tidak Ditemukan!', null);
    }


    /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        /**
         * Validate request
         */
        $validator = Validator::make($request->all(), [
            'majors_id' => 'required',
            'classstudents_id' => 'required',
            'schedule_mondays_id' => 'required',
            'schedule_tuesdays_id' => 'required',
            'schedule_wednesdays_id' => 'required',
            'schedule_thursdays_id' => 'required',
            'schedule_fridays_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update Schedule
        $schedule->update([
            'majors_id'   => $request->majors_id,
            'classstudents_id' => $request->classstudents_id,
            'schedule_mondays_id' => $request->schedule_mondays_id,
            'schedule_tuesdays_id' => $request->schedule_tuesdays_id,
            'schedule_wednesdays_id' => $request->schedule_wednesdays_id,
            'schedule_thursdays_id' => $request->schedule_thursdays_id,
            'schedule_fridays_id' => $request->schedule_fridays_id,
        ]);

        if ($schedule) {
            // Return success with Api Resource
            return new ScheduleResource(true, 'Data Jadwal Mata Pelajaran Berhasil di Update', $schedule);
        }

        // Return failed with Api Resource
        return new ScheduleResource(false, 'Data  Jadwal Mata Pelajaran Gagal di Update', null);
    }
    
    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan schedule by ID
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return new ScheduleResource(false, 'Data Jadwal Mata Pelajaran Tidak Ditemukan!', null);
        }

        // Hapus schedule
        if ($schedule->delete()) {
            // Return success with Api Resource
            return new ScheduleResource(true, 'Data Jadwal Mata Pelajaran Berhasil di Hapus!', null);
        }

        // Return failed with Api Resource
        return new ScheduleResource(false, 'Data Jadwal Mata Pelajaran Gagal di Hapus!', null);
    }


    /**
     * all
     * 
     * @return void
     */
    public function all()
    {
        // Dapatkan semua Schedule
        $schedules = Schedule::latest()->get();

        // Kembalikan dengan Api Resource
        return new ScheduleResource(true, 'List Data Jadwal Mata Pelajaran', $schedules);
    }
}

