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
            $userteam = DB::table('teams')->where('userids','=', $useridint)->get();
            return view('index', compact(['news','userteam']));
        }
        return view('index', compact(['news']));
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
        return view('team', compact(['team']));
    }
}
