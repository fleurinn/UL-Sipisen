<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Resources\RoleResource;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get roles
        $roles = Role::when(request()->search, function($roles) {
            $roles = $roles->where('name', 'like', '%'. request()->search . '&');
        })->with('permissions')->latest()->paginate(5);

        //append query string to pagination links
        $roles->appends(['search' => request()->search]);

        //return with Api resource
        return new RoleResource(true, 'List Data Roles', $roles);
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
            'name'          => 'required',
            'permissions'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create role
        $role = Role::create(['name' => $request->name]);

        //assign permissions to role
        $role->givePermissionTo($request->permissions);

        if($role) {
            //return success with Api Resource
            return new RoleResource(true, 'Data Role Success To Save', $role);
        }

        //return failed with Api Resource
        return new RoleResource(false, 'Data Role Fail To Save', null);
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
        $role = Role::with('permissions')->findOrFail($id);

        if($role) {
            //return success with Api Resource
            return new RoleResource(true, 'Detail Data Role', $role);
        }

        //return failed with Api Resource
        return new RoleResource(false, 'Data Role Not Found', null);
    }

    /**
     * Update the specified resource in strogae.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        /**
         * validate request
         */
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'permissions'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //update role
        $role->update(['name' => $request->name]);

        //sync permissions
        $role->syncPermissions($request->permissions);

        if($role) {
            //return success with Api Resource
            return new RoleResource(true, 'Data Role Success To Update', $role);
        }

        //return failed with Api Resource
        return new RoleResource(false, 'Data Role Fail To Update', null);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find role by ID
        $role = Role::findOrFail($id);

        //delete role
        if($role->delete()) {
            //return success with Api Resource
            return new RoleResource(true, 'Data Role Success To Delete!', null);
        }

        //return failed with Api Resource
        return new RoleResource(false, 'Data Role Fail To Delete!', null);
    }

    /**
     * all
     * 
     * @return void
     */
    public function all()
    {
        //get roles
        $roles = Role::latest()->get();

        //return with Api Resource
        return new RoleResource(true, 'List Data Roles', $roles);
    }
}