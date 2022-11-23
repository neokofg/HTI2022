<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class uploadcontroller extends Controller
{
    protected function addHackathon(Request $request){
        $validateFields = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'date' => 'required|date',
            'prize' => 'required|integer',
            'description' => 'required'
        ]);
        $name = $request->input('name');
        $prize = $request->input('prize');
        $description = $request->input('description');
        $date = $request->input('date');
        $file= $request->file('image');
        $filename= date('YmdHi').$file->hashName();
        $file-> move(public_path('images'), $filename);
        $data = array('name' => $name, 'date' =>  $date,'tracks' => '0','prize' => $prize, 'description' => $description,'image' => $filename,"created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'));
        DB::table('hackathons')->insert($data);
        return back();
    }
}
