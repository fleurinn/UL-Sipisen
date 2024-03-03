<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataStudentResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\DataStudent;
    
class DataStudentController extends Controller
    {
        /**
         * index
         *
         * @return View
         */
        public function index()
        {   
            $data_students = DataStudent::with(['classstudents' => function ($query) {
                $query->select('id', 'name');
            }])->select('id', 'classstudents_id','name','nisn','no_hp','alamat')
            ->when(request()->search, function($query) {
                $query->where('classstudents_id', 'like', '%' . request()->search . '%');
            })->latest()->paginate(5);
    
            //append query string to pagination links
            $data_students->appends(['search' => request()->search]);
    
            //return with Api Resource
            return new DataStudentResource(true, 'List Data Siswa', $data_students);
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
                'classstudents_id'=> 'required',
                'name' => 'required',
                'nisn' => 'required',
                'no_hp' => 'required',
                'alamat' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Create DataStudent
            $datastudent = DataStudent::create([
                'classstudents_id'=> $request->classstudents_id,
                'name' => $request->name,
                'nisn' => $request->nisn,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);

            if ($datastudent) {
                // Return success with Api Resource
                return new DataStudentResource(true, 'Data Siswa Berhasil di Simpan!', $datastudent);
            }

            // Return failed with Api Resource
            return new DataStudentResource(false, 'Data Siswa Gagal di Simpan!', null);
        }
    
        /**
         * show the form for editing the specified resource.
         * 
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //get role
            $data_students = DataStudent::with(['classstudents' => function ($query) {
                $query->select('id', 'name');
            }])->select('id', 'classstudents_id','name','nisn','no_hp','alamat')
            ->where('classstudents_id', $id)->get();

            if($datastudent) {
                //return success with Api Resource
                return new DataStudentResource(true, 'Detail Data Siswa', $datastudent);
            }
    
            //return failed with Api Resource
            return new DataStudentResource(false, 'Data Siswa Tidak Ditemukan', null);
        }
    
        /**
         * Update the specified resource in storage.
         * 
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, DataStudent $datastudent)
        {
            /**
             * Validate request
             */
            $validator = Validator::make($request->all(), [
                'classstudents_id'=> 'required',
                'name' => 'required',
                'nisn' => 'required',
                'no_hp' => 'required',
                'alamat' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Update DataStudent
            $datastudent->update([
                'classstudents_id'=> $request->classstudents_id,
                'name' => $request->name,
                'nisn' => $request->nisn,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);

            if ($datastudent) {
                // Return success with Api Resource
                return new DataStudentResource(true, 'Data Siswa Berhasil di Update', $datastudent);
            }

            // Return failed with Api Resource
            return new DataStudentResource(false, 'Data Siswa Gagal di Update', null);
        }
    
        /**
         * Remove the specified resource from storage.
         * 
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            // Find dataguru by ID
            $datastudent = DataStudent::findOrFail($id);

            // Delete dataguru
            if ($datastudent->delete()) {
                // Return success with Api Resource
                return new DataStudentResource(true, 'Data Siswa Berhasil di Hapus!', null);
            }

            // Return failed with Api Resource
            return new DataStudentResource(false, 'Data Siswa Gagal di Hapus!', null);
        }

        /**
         * all
         * 
         * @return void
         */
        public function all()
        {
            // //get DataStudent
            $datastudent = DataStudent::latest()->get();

            //return with Api Resource
            return new DataStudentResource(true, 'List Data Siswa', $datastudent);
        }

        
    
    }