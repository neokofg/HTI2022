<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class getdatacontroller extends Controller
{
    protected function GetAllData(Request $request){
        $hackathons = DB::table('hackathons')->orderBy('created_at', 'DESC')->get();
        return view('index', compact(['hackathons']));
    }
}
