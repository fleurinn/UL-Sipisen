<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentAttendanceResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\StudentAttendance;
    
class StudentAttendanceController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        // Get StudentAttendance
        $studentattendances = StudentAttendance::with(['data_students' => function ($query) {
            $query->select('id', 'name');
        }])->when(request()->has('search'), function ($query) {
            $query->where('data_students_id', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);

        // Append query string to pagination links
        $studentattendances->appends(['search' => request()->search]);

        // Return with Api Resource
        return new StudentAttendanceResource(true, 'List Data Kehadiran Siswa', $studentattendances);
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
            'data_students_id' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create StudentAttendance
        $studentattendance = StudentAttendance::create([
            'data_students_id' => $request->data_students_id,
            'description' => $request->description,
        ]);

        if ($studentattendance) {
            // Return success with Api Resource
            return new StudentAttendanceResource(true, 'Data Kehadiran Siswa Berhasil di Simpan!', $studentattendance);
        }

        // Return failed with Api Resource
        return new StudentAttendanceResource(false, 'Data Kehadiran Siswa Gagal di Simpan!', null);
    }
    
    /**
     * show the form for editing the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studentattendance = StudentAttendance::with(['data_students' => function ($query) {
            $query->select('id', 'name');
        }])->whereId($id)->first();
        
        if($studentattendance) {
            // Return success with Api Resource
            return new StudentAttendanceResource(true, 'Detail Data Kehadiran!', $studentattendance);
        }
        
        // Return failed with Api Resource
        return new StudentAttendanceResource(false, 'Detail Data Kehadiran Tidak Ditemukan!', null);
    }


    /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentAttendance $studentattendance)
    {
        /**
         * Validate request
         */
        $validator = Validator::make($request->all(), [
            'data_students_id' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update StudentAttendance
        $studentattendance->update([
            'data_students_id'   => $request->data_students_id,
            'description' => $request->description,
        ]);

        if ($studentattendance) {
            // Return success with Api Resource
            return new StudentAttendanceResource(true, 'Data Kehadiran Siswa Berhasil di Update', $studentattendance);
        }

        // Return failed with Api Resource
        return new StudentAttendanceResource(false, 'Data  Kehadiran Siswa Gagal di Update', null);
    }
    
    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find studentattendance by ID
        $studentattendance = StudentAttendance::find($id);

        if (!$studentattendance) {
            return new StudentAttendanceResource(false, 'Data Kehadiran Siswa Tidak Ditemukan!', null);
        }

        // Delete studentattendance
        if ($studentattendance->delete()) {
            // Return success with Api Resource
            return new StudentAttendanceResource(true, 'Data Kehadiran Siswa Berhasil di Hapus!', null);
        }

        // Return failed with Api Resource
        return new StudentAttendanceResource(false, 'Data Kehadiran Siswa Gagal di Hapus!', null);
    }


    /**
     * all
     * 
     * @return void
     */
    public function all()
    {
        // //get StudentAttendance
        $studentattendance = StudentAttendance::latest()->get();

        //return with Api Resource
        return new StudentAttendanceResource(true, 'List Data Kehadiran Kehadiran Siswa', $studentattendance);
    }
}

