<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainUserController extends Controller
{
    //
    public function main(){
        return view('user.main');
    }
    public function home(){
        return view('user.pages.home');
    }public function sanpham(){
        return view('user.pages.sanpham');
    }
}
