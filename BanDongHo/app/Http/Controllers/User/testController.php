<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class testController extends Controller
{
    //
    public function showtest(){
        
        $human = DB::table('test')->get();
        dd($human);
        return view('user.pages.tesst',compact('human'));
    }

  
}
