<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class getdatacontroller extends Controller
{
    protected function GetAllData(Request $request){
        $news = DB::table('news')->orderBy('created_at', 'DESC')->get();
        if(Auth::check()){
            $userid = Auth::user()->id;
            $useridint = (string)$userid;
            $teamscolumn = DB::table('teams')->get();
            foreach ($teamscolumn as $column){
                $explode_id = array_map('intval', explode(',', $column->userids));
                    foreach ($explode_id as $exploded){
                        if($useridint == $exploded){
                            $userteam = DB::table('teams')->where('id','=', $column->id)->get();
                            return view('index', compact(['news','userteam']));
                        }
                    }
            }
        }
        $userteam = '[]';
        return view('index', compact(['news','userteam']));
    }
    protected function GetHackathonData(Request $request){
        $id = $_GET['id'];
        $hackathon = DB::table('hackathons')->where('id','=',$id)->get();
        return view('hackathon', compact(['hackathon']));
    }
    protected function GetHackathonsData(Request $request){
        $hackathons = DB::table('hackathons')->orderBy('created_at', 'DESC')->get();
        return view('hackathons', compact(['hackathons']));
    }
    protected function GetTeamsData(Request $request){
        $teams = DB::table('teams')->orderBy('created_at', 'DESC')->get();
        return view('teams', compact(['teams']));
    }
    protected function GetTeamData(Request $request){
        $id = $_GET['id'];
        $team = DB::table('teams')->where('id','=',$id)->get();
        $requests = DB::table('requests')->where('teamid', '=', $id)->get('userid');
        $requestz = DB::table('requests')->where('teamid', '=', $id)->get();
        if($requestz != '[]'){
            $requests2 = explode(':',$requests);
            $requests2 = explode('}',$requests2[1]);
            $userrequests = DB::table('users')->where('id','=', $requests2[0])->get();
            return view('team', compact(['team','userrequests','requestz']));
        }
        $userrequests = null;
        return view('team', compact(['team','userrequests','requestz']));
    }
}
