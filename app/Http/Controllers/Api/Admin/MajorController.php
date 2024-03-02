<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MajorResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Major;
    
class MajorController extends Controller
    {
        /**
         * index
         *
         * @return View
         */
        public function index()
        {
            //get Major
            $majors = Major::when(request()->search, function($majors) {
                $majors = $majors->where('name', 'like', '%'. request()->search . '&');
            })->latest()->paginate(5);


    
            //append query string to pagination links
            $majors->appends(['search' => request()->search]);
    
            //return with Api Resource
            return new MajorResource(true, 'List Data Jurusan', $majors);
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

            // Create Major
            $major = Major::create([
                'name' => $request->name,
            ]);

            if ($major) {
                // Return success with Api Resource
                return new MajorResource(true, 'Data Jurusan Berhasil di Simpan!', $major);
            }

            // Return failed with Api Resource
            return new MajorResource(false, 'Data Jurusan Gagal di Simpan!', null);
        }
    
        /**
         * show the form for editing the specified resource.
         * 
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $major = Major::findOrFail($id);
            
            if($major) {
                //return success with Api Resource
                return new MajorResource(true, 'Detail Data Jurusan', $major);
            }
    
            //return failed with Api Resource
            return new MajorResource(false, 'Data Jurusan Tidak Ditemukan', null);
        }
    
        /**
         * Update the specified resource in storage.
         * 
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Major $major)
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

            // Update Major
            $major->update([
                'name' => $request->name,
            ]);

            if ($major) {
                // Return success with Api Resource
                return new MajorResource(true, 'Data Jurusan Berhasil di Update', $major);
            }

            // Return failed with Api Resource
            return new MajorResource(false, 'Data Jurusan Gagal di Update', null);
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
            $major = Major::findOrFail($id);

            // Delete dataguru
            if ($major->delete()) {
                // Return success with Api Resource
                return new MajorResource(true, 'Data Jurusan Berhasil di Hapus!', null);
            }

            // Return failed with Api Resource
            return new MajorResource(false, 'Data Jurusan Gagal di Hapus!', null);
        }

        /**
         * all
         * 
         * @return void
         */
        public function all()
        {
            //get Major
            $major = Major::latest()->get();
    
            //return with Api Resource
            return new MajorResource(true, 'List Data Jurusan', $major);
        }
    
    }