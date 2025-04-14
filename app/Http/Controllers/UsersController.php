<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function index(){
        $users = User::all();
        return view('welcome', compact('users'));
    }
    
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
