<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function viewproduct(){
        $product = DB::table('products')->get();
        return view('user.pages.sanpham',compact('product'));
    }

    public function chitietsanpham($idsp){
        // dd($idsp);
        $product = DB::table('products')->where('idsp',$idsp )->get();
        return view('user.pages.chitietsanpham',compact('product'));
    }
}
