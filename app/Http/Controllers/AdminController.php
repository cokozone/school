<?php

namespace App\Http\Controllers;
use Illumonate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function Logout(){
        Auth::logout();
        return Redirect()->route('login');
    }
}
