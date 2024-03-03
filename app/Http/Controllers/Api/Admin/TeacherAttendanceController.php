<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherAttendanceResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\TeacherAttendance;
    
class TeacherAttendanceController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        // Get TeacherAttendance
        $teacherattendances = TeacherAttendance::with(['data_teachers' => function ($query) {
            $query->select('id', 'name');
        }])->select('id', 'data_teachers_id','tanggal', 'description')
        ->when(request()->search, function($query) {
            $query->where('data_teachers_id', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);
    

        // Append query string to pagination links
        $teacherattendances->appends(['search' => request()->search]);

        // Return with Api Resource
        return new TeacherAttendanceResource(true, 'List Data Kehadiran Guru', $teacherattendances);
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
            'data_teachers_id' => 'required',
            'tanggal' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create TeacherAttendance
        $teacherattendance = TeacherAttendance::create([
            'data_teachers_id' => $request->data_teachers_id,
            'tanggal' => $request->tanggal,
            'description' => $request->description,
        ]);

        if ($teacherattendance) {
            // Return success with Api Resource
            return new TeacherAttendanceResource(true, 'Data Kehadiran Guru Berhasil di Simpan!', $teacherattendance);
        }

        // Return failed with Api Resource
        return new TeacherAttendanceResource(false, 'Data Kehadiran Guru Gagal di Simpan!', null);
    }
    
    /**
     * show the form for editing the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacherattendances = TeacherAttendance::with(['data_teachers' => function ($query) {
            $query->select('id', 'name');
        }])->select('id', 'data_teachers_id','tanggal', 'description')
        ->where('data_teachers_id', $id)->get();

        if($teacherattendance) {
            // Return success with Api Resource
            return new TeacherAttendanceResource(true, 'Detail Data Kehadiran!', $teacherattendance);
        }
        
        // Return failed with Api Resource
        return new TeacherAttendanceResource(false, 'Detail Data Kehadiran Tidak Ditemukan!', null);
    }


    /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherAttendance $teacherattendance)
    {
        /**
         * Validate request
         */
        $validator = Validator::make($request->all(), [
            'data_teachers_id' => 'required',
            'tanggal' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update TeacherAttendance
        $teacherattendance->update([
            'data_teachers_id'   => $request->data_teachers_id,
            'tanggal'   => $request->tanggal,
            'description' => $request->description,
        ]);

        if ($teacherattendance) {
            // Return success with Api Resource
            return new TeacherAttendanceResource(true, 'Data Kehadiran Guru Berhasil di Update', $teacherattendance);
        }

        // Return failed with Api Resource
        return new TeacherAttendanceResource(false, 'Data  Kehadiran Guru Gagal di Update', null);
    }
    
    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find TeacherAttendance by ID
        $teacherattendance = TeacherAttendance::find($id);

        if (!$teacherattendance) {
            return new TeacherAttendanceResource(false, 'Data Kehadiran Guru Tidak Ditemukan!', null);
        }

        // Delete TeacherAttendance
        if ($teacherattendance->delete()) {
            // Return success with Api Resource
            return new TeacherAttendanceResource(true, 'Data Kehadiran Guru Berhasil di Hapus!', null);
        }

        // Return failed with Api Resource
        return new TeacherAttendanceResource(false, 'Data Kehadiran Guru Gagal di Hapus!', null);
    }


    /**
     * all
     * 
     * @return void
     */
    public function all()
    {
        // //get TeacherAttendance
        $teacherattendance = TeacherAttendance::latest()->get();

        //return with Api Resource
        return new TeacherAttendanceResource(true, 'List Data Kehadiran Kehadiran Guru', $teacherattendance);
    }
}

