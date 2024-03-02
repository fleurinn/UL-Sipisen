<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Subject;
    
class SubjectController extends Controller
    {
        /**
         * index
         *
         * @return View
         */
        public function index()
        {
            //get Subject
            $subjects = Subject::when(request()->search, function($subjects) {
                $subjects = $subjects->where('name', 'like', '%'. request()->search . '&');
            })->latest()->paginate(5);


    
            //append query string to pagination links
            $subjects->appends(['search' => request()->search]);
    
            //return with Api Resource
            return new SubjectResource(true, 'List Data Jurusan', $subjects);
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

            // Create Subject
            $subject = Subject::create([
                'name' => $request->name,
            ]);

            if ($subject) {
                // Return success with Api Resource
                return new SubjectResource(true, 'Data Jurusan Berhasil di Simpan!', $subject);
            }

            // Return failed with Api Resource
            return new SubjectResource(false, 'Data Jurusan Gagal di Simpan!', null);
        }
    
        /**
         * show the form for editing the specified resource.
         * 
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $subject = Subject::findOrFail($id);
            
            if($subject) {
                //return success with Api Resource
                return new SubjectResource(true, 'Detail Data Jurusan', $subject);
            }
    
            //return failed with Api Resource
            return new SubjectResource(false, 'Data Jurusan Tidak Ditemukan', null);
        }
    
        /**
         * Update the specified resource in storage.
         * 
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Subject $subject)
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

            // Update Subject
            $subject->update([
                'name' => $request->name,
            ]);

            if ($subject) {
                // Return success with Api Resource
                return new SubjectResource(true, 'Data Jurusan Berhasil di Update', $subject);
            }

            // Return failed with Api Resource
            return new SubjectResource(false, 'Data Jurusan Gagal di Update', null);
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
            $subject = Subject::findOrFail($id);

            // Delete dataguru
            if ($subject->delete()) {
                // Return success with Api Resource
                return new SubjectResource(true, 'Data Jurusan Berhasil di Hapus!', null);
            }

            // Return failed with Api Resource
            return new SubjectResource(false, 'Data Jurusan Gagal di Hapus!', null);
        }

        /**
         * all
         * 
         * @return void
         */
        public function all()
        {
            //get Subject
            $subject = Subject::latest()->get();
    
            //return with Api Resource
            return new SubjectResource(true, 'List Data Jurusan', $subject);
        }
    
    }