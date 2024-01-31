<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon; //untuk datetime
use App\Models\User;
use Illuminate\Support\Facades\DB; //untuk query database

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //count users
        $users = User::count();

        
        
        //return response json
        return response()->json([
            'succes'    => true,
            'message'   => 'List Data on Dashboard',
            'data'      => [
                'users'       => $users,
            ]
        ]);
    }
}