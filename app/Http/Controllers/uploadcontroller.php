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
            'description' => 'required',
            'track' => 'required'
        ]);
        $name = $request->input('name');
        $prize = $request->input('prize');
        $description = $request->input('description');
        $date = $request->input('date');
        $track = $request->input('track');
        $file= $request->file('image');
        $filename= date('YmdHi').$file->hashName();
        $file-> move(public_path('images'), $filename);
        $data = array('name' => $name, 'date' =>  $date,'tracks' => $track,'prize' => $prize, 'description' => $description,'image' => $filename,"created_at" =>  date('Y-m-d H:i:s'),
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
    protected function participate(Request $request){
        $validateFields = $request->validate([
            'hackid' => 'required|exists:hackathons,id',
        ]);
        $hackid = $request->input('hackid');
        $userid = Auth::user()->id;
        $useridint = (string)$userid;
        $teamscolumn = DB::table('teams')->get();
        foreach ($teamscolumn as $column){
            $explode_id = array_map('intval', explode(',', $column->userids));
            foreach ($explode_id as $exploded){
                if($useridint == $exploded){
                    $userteam = DB::table('teams')->where('id','=', $column->id)->get();
                    foreach ($userteam as $user){
                        if($user->leaderid == $userid){
                            $hackathon = DB::table('hackathons')->where('id','=',$hackid)->get('teams');
                                foreach ($hackathon as $hack){
                                    if($hack->teams != null){
                                        $hackathon2 = explode(':',$hackathon);
                                        $hackathon2 = explode('}',$hackathon2[1]);
                                        $hackathon2 = explode('"',$hackathon2[0]);
                                        $userids = $hackathon2[1] . ',' . $user->id;
                                        $data = array('teams' => $userids);
                                    }else{
                                        $data = array('teams' => $user->id);
                                    }
                                }
                            DB::table('hackathons')->where('id','=',$hackid)->update($data);
                                $myteamid = $column->id;
                                $hackathonid = $hackid;
                                $data = array('teamid' => $myteamid,'hackathonid' => $hackathonid,'checkpointnumber' => '0', "created_at" =>  date('Y-m-d H:i:s'),
                                    "updated_at" => date('Y-m-d H:i:s'));
                                DB::table('hackathonparticipants')->insert($data);
                                DB::table('checkpoints')->where('hackid','=',$hackid)->get();
                                foreach ($checkpoints as $check){
                                    if($check->teams != null){
                                        $hackathon2 = explode(':',$check->teams);
                                        $hackathon2 = explode('}',$hackathon2[1]);
                                        $hackathon2 = explode('"',$hackathon2[0]);
                                        $userids = $hackathon2[1] . ',' . $user->id;
                                        $data = array('teams' => $userids);
                                    }else{
                                        $data = array('teams' => $user->id);
                                    }
                                }
                            return redirect()->back()->with('success', 'Успешно!');
                        }else{
                            return(redirect(route('index')));
                        }
                    }
                }
            }
        }
    }
    protected function addTrack(Request $request){
        $validateFields = $request->validate([
            'name' => 'required',
            'file' => 'required|mimes:pdf,xlxs,xlx,docx,doc,csv,txt,png,gif,jpg,jpeg',
            'description' => 'required'
        ]);
        $name = $request->input('name');
        $description = $request->input('description');
        $file= $request->file('file');
        $filename= date('YmdHi').$file->hashName();
        $file-> move(public_path('images'), $filename);
        $data = array('name' => $name, 'description' => $description,'pdf' => $filename,"created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'));
        DB::table('tracks')->insert($data);
        return back();
    }
    protected function editHackathon(Request $request){
        $validateFields = $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'date' => 'required',
            'description' => 'required',
            'prize' => 'required',
            'id'=> 'required',
            'track' => 'required'
        ]);
        $name= $request->input('name');
        $description= $request->input('description');
        $date= $request->input('date');
        $prize= $request->input('prize');
        $id= $request->input('id');
        if($pageimage= $request->file('image')){
            $pageimagename= date('YmdHi').$pageimage->hashName();
            $pageimage-> move(public_path('images'), $pageimagename);
        }else{
            $nameimage = DB::table('hackathons')->where('id','=',$id)->get('image');
            foreach ($nameimage as $images){
                $pageimagename = $images->image;
            }
        }
        $data = array('name' => $name, 'description' => $description,'prize'=>$prize,'date' => $date,'image' => $pageimagename,"updated_at" => date('Y-m-d H:i:s'));
        DB::table('hackathons')->where('id',$id)->update($data);
        return redirect()->back()->with('success', 'Успешно!');
    }
    protected function deleteHackathon(Request $request){
        $id = $request->input('id');
        DB::table('hackathons')->where('id',$id)->delete();
        return redirect(route('hackathons'))->with('success', 'Успешно!');
    }
    protected function editUser(Request $request){
        $validateFields = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
        ]);
        $name= $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        if($request->input('contacts') != null){
            $contacts = $request->input('contacts');
        }else{
            $contacts = null;
        }
        if($request->input('stack') != null){
            $stack = $request->input('stack');
        }else{
            $stack = null;
        }
        if($request->input('description') != null){
            $description = $request->input('description');
        }else{
            $description = null;
        }
        $data = array('name' => $name, 'surname' => $surname, 'email' => $email,'contacts' => $contacts, 'stack' => $stack, 'description' => $description,"updated_at" => date('Y-m-d H:i:s'));
        DB::table('users')->where('id','=',Auth::user()->id)->update($data);
        return redirect(route('private'))->with('success', 'Успешно!');
    }
    protected function createCheckpoint(Request $request){
        $validateFields = $request->validate([
            'hackid' => 'required|exists:hackathons,id',
            'checkpointnumber' => 'required',
            'time' => 'required',
        ]);
        $hackid = $request->input('hackid');
        $checkpointnumber = $request->input('checkpointnumber');
        $time = $request->input('time');
        $hackathons = DB::table('hackathons')->where('id','=',$hackid)->get();
        foreach ($hackathons as $hackathon){
            $data = array('hackathonid' => $hackid,'checkpointnumber' => $checkpointnumber,'teams' => $hackathon->teams, 'time' => $time,"created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'));
            DB::table('checkpoints')->insert($data);
            return redirect(route('hackathoneditor'))->with('success', 'Успешно!');
        }
    }
}
