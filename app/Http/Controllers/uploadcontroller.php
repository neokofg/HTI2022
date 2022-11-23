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
    protected function addNews(Request $request){
        $validateFields = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'content' => 'required'
        ]);
        $name = $request->input('name');
        $content = $request->input('content');
        $file= $request->file('image');
        $filename= date('YmdHi').$file->hashName();
        $file-> move(public_path('images'), $filename);
        $data = array('name' => $name, 'content' => $content,'image' => $filename,"created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'));
        DB::table('news')->insert($data);
        return back();
    }
    protected function createTeam(Request $request){
        $validateFields = $request->validate([
            'name' => 'required|unique:teams',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required'
        ]);
        $name = $request->input('name');
        $content = $request->input('description');
        $userid = Auth::user()->id;
        $file= $request->file('image');
        $filename= date('YmdHi').$file->hashName();
        $file-> move(public_path('images'), $filename);
        $data = array('userids'=>$userid,'leaderid'=>$userid,'name' => $name, 'description' => $content,'image' => $filename,"created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'));
        DB::table('teams')->insert($data);
        return back();
    }
    protected function requestToTeam(Request $request){
        $validateFields = $request->validate([
            'teamid' => 'required|exists:teams,id',
        ]);
        $teamid = $request->input('teamid');
        $userid = Auth::user()->id;
        $data = array("teamid" => $teamid,'status' => 0, 'userid' => $userid, "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'));
        DB::table('requests')->insert($data);
        return back();
    }
    protected function acceptRequest(Request $request){
        $validateFields = $request->validate([
            'requestid' => 'required|exists:requests,id',
        ]);
        $requestid = $request->input('requestid');
        $requests = DB::table('requests')->where('id', '=', $requestid)->get('userid');
        $requests2 = explode(':',$requests);
        $requests2 = explode('}',$requests2[1]);
        $requestteam = DB::table('requests')->where('id', '=', $requestid)->get('teamid');
        $requeststeam2 = explode(':',$requestteam);
        $requeststeam2 = explode('}',$requeststeam2[1]);
        $teams = DB::table('teams')->where('id','=',$requeststeam2[0])->get('userids');
        $team2 = explode(':',$teams);
        $team2 = explode('}',$team2[1]);
        $team2 = explode('"',$team2[0]);
        $userids = $team2[1] . ',' . $requests2[0];
        $data = array('userids' => $userids);
        DB::table('teams')->where('id','=',$requeststeam2[0])->update($data);
        DB::table('requests')->where('id',$requestid)->delete();
        return redirect()->back()->with('success', 'Успешно!');
    }
    protected function declineRequest(Request $request){
        $validateFields = $request->validate([
            'requestid' => 'required|exists:requests,id',
        ]);
        $requestid = $request->input('requestid');
        DB::table('requests')->where('id',$requestid)->delete();
        return redirect()->back()->with('success', 'Успешно!');
    }
}
