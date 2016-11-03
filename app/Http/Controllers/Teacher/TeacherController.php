<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('isTeacher');
    }

    public function index()
    {
        return view('welcome');
    }
}
