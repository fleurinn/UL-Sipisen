<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassStudentResource;
use Illuminate\Support\Facades\Validator;
use App\Models\ClassStudent;
    
class ClassStudentController extends Controller
    {
        /**
         * index
         *
         * @return View
         */
        public function index()
        {
            //get ClassStudent
            $classstudents  = ClassStudent::when(request()->search, function($classstudents) {
                $classstudents  = $classstudents->where('name', 'like', '%'. request()->search . '%');
            })->latest()->paginate(5);
    
            //append query string to pagination links
            $classstudents->appends(['search' => request()->search]);
    
            //return with Api Resource
            return new ClassStudentResource(true, 'List Data Kelas', $classstudents);
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
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Create ClassStudent
            $classstudent = ClassStudent::create([
                'name' => $request->name,
            ]);

            if ($classstudent) {
                // Return success with Api Resource
                return new ClassStudentResource(true, 'Data Kelas Berhasil di Simpan!', $classstudent);
            }

            // Return failed with Api Resource
            return new ClassStudentResource(false, 'Data Kelas Gagal di Simpan!', null);
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
            $classstudent = ClassStudent::findOrFail($id);
    
            if($classstudent) {
                //return success with Api Resource
                return new ClassStudentResource(true, 'Detail Data Kelas', $classstudent);
            }
    
            //return failed with Api Resource
            return new ClassStudentResource(false, 'Data Kelas Tidak Ditemukan', null);
        }
    
        /**
         * Update the specified resource in storage.
         * 
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, ClassStudent $classstudent)
        {
            /**
             * Validate request
             */
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Update ClassStudent
            $classstudent->update([
                'name' => $request->name,
            ]);

            if ($classstudent) {
                // Return success with Api Resource
                return new ClassStudentResource(true, 'Data Kelas Berhasil di Update', $classstudent);
            }

            // Return failed with Api Resource
            return new ClassStudentResource(false, 'Data Kelas Gagal di Update', null);
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
            $classstudent = ClassStudent::findOrFail($id);

            // Delete dataguru
            if ($classstudent->delete()) {
                // Return success with Api Resource
                return new ClassStudentResource(true, 'Data Kelas Berhasil di Hapus!', null);
            }

            // Return failed with Api Resource
            return new ClassStudentResource(false, 'Data Kelas Gagal di Hapus!', null);
        }

        /**
         * all
         * 
         * @return void
         */
        public function all()
        {
            //get ClassStudent
            $classstudent = ClassStudent::latest()->get();
    
            //return with Api Resource
            return new ClassStudentResource(true, 'List Data Kelas', $classstudent);
        }
    
    }