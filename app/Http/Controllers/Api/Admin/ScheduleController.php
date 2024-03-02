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
        $scheduleMonday = DB::table('schedule_mondays')
        ->join('subjects', 'schedule_mondays.subjects_id', '=', 'subjects.id')
        ->join('data_teachers', 'schedule_mondays.data_teachers_id', '=', 'data_teachers.id')
        ->select('schedule_mondays.*', 'subjects.name as subject_name', 'data_teachers.name as teacher_name')
        ->get();
    
        $scheduleTuesday = DB::table('schedule_tuesdays')
        ->join('subjects', 'schedule_tuesdays.subjects_id', '=', 'subjects.id')
        ->join('data_teachers', 'schedule_tuesdays.data_teachers_id', '=', 'data_teachers.id')
        ->select('schedule_tuesdays.*', 'subjects.name as subject_name', 'data_teachers.name as teacher_name')
        ->get();
    
    return [
        'scheduleMonday' => $scheduleMonday,
        'scheduleTuesday' => $scheduleTuesday,
    ];
    

        // Return dengan Api Resource
        return new ScheduleResource(true, 'List Data Kehadiran Siswa', $schedules);
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
            return new ScheduleResource(true, 'Data Kehadiran Siswa Berhasil di Simpan!', $schedule);
        }

        // Return failed with Api Resource
        return new ScheduleResource(false, 'Data Kehadiran Siswa Gagal di Simpan!', null);
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
            'schedule_mondays' => function ($query) {
                $query->select('id', 'subjects_id', 'data_teachers_id', 'start_time', 'end_time');
            },
            'schedule_tuesdays' => function ($query) {
                $query->select('id', 'subjects_id', 'data_teachers_id', 'start_time', 'end_time');
            },
            'schedule_wednesdays' => function ($query) {
                $query->select('id', 'subjects_id', 'data_teachers_id', 'start_time', 'end_time');
            },
            'schedule_thursdays' => function ($query) {
                $query->select('id', 'subjects_id', 'data_teachers_id', 'start_time', 'end_time');
            },
            'schedule_fridays' => function ($query) {
                $query->select('id', 'subjects_id', 'data_teachers_id', 'start_time', 'end_time');
            }
        ])->where('classstudents_id', $id)->get();

        if($schedule) {
            // Return success with Api Resource
            return new ScheduleResource(true, 'Detail Data Kehadiran!', $schedule);
        }
        
        // Return failed with Api Resource
        return new ScheduleResource(false, 'Detail Data Kehadiran Tidak Ditemukan!', null);
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
            return new ScheduleResource(true, 'Data Kehadiran Siswa Berhasil di Update', $schedule);
        }

        // Return failed with Api Resource
        return new ScheduleResource(false, 'Data  Kehadiran Siswa Gagal di Update', null);
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
            return new ScheduleResource(false, 'Data Kehadiran Siswa Tidak Ditemukan!', null);
        }

        // Hapus schedule
        if ($schedule->delete()) {
            // Return success with Api Resource
            return new ScheduleResource(true, 'Data Kehadiran Siswa Berhasil di Hapus!', null);
        }

        // Return failed with Api Resource
        return new ScheduleResource(false, 'Data Kehadiran Siswa Gagal di Hapus!', null);
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
        return new ScheduleResource(true, 'List Data Kehadiran Kehadiran Siswa', $schedules);
    }
}

