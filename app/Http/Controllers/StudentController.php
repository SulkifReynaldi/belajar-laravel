<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        return view("welcome");
    }
    public function Profile($nama){
        return $nama;
    }

}
