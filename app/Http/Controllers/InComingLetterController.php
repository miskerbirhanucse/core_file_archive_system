<?php

namespace App\Http\Controllers;

use App\Models\InComingLetter;
use App\Models\Project;
use Illuminate\Http\Request;

class InComingLetterController extends Controller
{
    public function searchInComingLetter(Request $request){
        $letters=InComingLetter::where('project_id','=',$request->project_id)->where('subject','like', '%'.$request->subject.'%')->paginate(10);
        $projects=Project::all();
        $actionTaken=InComingLetter::whereNotNull('action_taker_user_id')->count();
        if(auth()->user()->role == 'GM'){
            return view('letter.gm_list',['totalLetter'=>$letters->total(),'letters'=>$letters,'actionTaken'=>$actionTaken,'projects'=>$projects]);
        }
        return view('letter.letter_list',['letters'=>$letters,'projects'=>$projects]);
    }
}
