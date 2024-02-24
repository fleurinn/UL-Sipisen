<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataTeacherResource;
use Illuminate\Support\Facades\Validator;
use App\Models\DataTeacher;
    
class DataTeacherController extends Controller
    {
        /**
         * index
         *
         * @return View
         */
        public function index()
        {
            //get DataTeacher
            $data_teachers  = DataTeacher::when(request()->search, function($data_teachers) {
                $data_teachers  = $data_teachers->where('name', 'like', '%'. request()->search . '%');
            })->latest()->paginate(5);
    
            //append query string to pagination links
            $data_teachers->appends(['search' => request()->search]);
    
            //return with Api Resource
            return new DataTeacherResource(true, 'List Data Guru', $data_teachers);
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
                    'nip' => 'required',
                    'gender' => 'required',
                    'subject' => 'required',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }
    
           // Create DataTeacher
            $datateacher = DataTeacher::create([
                'name' => $request->name,
                'nip' => $request->nip,
                'gender' => $request->gender,
                'subject' => $request->subject,
            ]);

            if ($datateacher) {
                // Return success with Api Resource
                return new DataTeacherResource(true, 'Data Guru Berhasil di Simpan!', $datateacher);
            }

            // Return failed with Api Resource
            return new DataTeacherResource(false, 'Data Guru Gagal di Simpan!', null);
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
            $datateacher = DataTeacher::findOrFail($id);
    
            if($datateacher) {
                //return success with Api Resource
                return new DataTeacherResource(true, 'Detail Data Guru', $datateacher);
            }
    
            //return failed with Api Resource
            return new DataTeacherResource(false, 'Data Guru Tidak Ditemukan', null);
        }
    
        /**
         * Update the specified resource in strogae.
         * 
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, DataTeacher $datateacher)
        {
            /**
             * validate request
             */
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'nip' => 'required',
                'gender' => 'required',
                'subject' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Update DataTeacher
            $datateacher->update([
                'name' => $request->name,
                'nip' => $request->nip,
                'gender' => $request->gender,
                'subject' => $request->subject,
            ]);

            if ($datateacher) {
                // Return success with Api Resource
                return new DataTeacherResource(true, 'Data Guru Berhasil di Update', $datateacher);
            }

            // Return failed with Api Resource
            return new DataTeacherResource(false, 'Data Guru Gagal di Update', null);
        }
    
        /**
         * Remove the specified resource from storage.
         * 
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //find dataguru by ID
            $datateacher = DataTeacher::findOrFail($id);
    
            //delete dataguru
            if($datateacher->delete()) {
                //return success with Api Resource
                return new DataTeacherResource(true, 'Data Guru Berhasil di Hapus!', null);
            }
    
            //return failed with Api Resource
            return new DataTeacherResource(false, 'Data Guru Gagal di Hapus!', null);
        }
    
        /**
         * all
         * 
         * @return void
         */
        public function all()
        {
            //get datateacher
            $datateacher = DataTeacher::latest()->get();
    
            //return with Api Resource
            return new DataTeacherResource(true, 'List Data Guru', $datateacher);
        }
    
    }