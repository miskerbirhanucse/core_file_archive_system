<?php

namespace App\Http\Controllers;

use App\Models\DepartmentInComingLetter;
use App\Models\Users ;
use App\Models\Department;
use App\Models\InComingLetter;
use App\Notifications\LetterNotification;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class LetterController extends Controller
{
    //
    public function showCreatePage(){
        $projects=Project::all();
        return view('letter.create_letter',['projects'=>$projects]);
    }
    public function showListPage(){
        $projects=Project::all();
        $letters=InComingLetter::where('uploader_user_id',auth()->user()->id)->orderBy('created_at','DESC')->paginate(10);
        return view('letter.secretary_letter_list',['letters'=>$letters,'projects'=>$projects]);
    }
    public function showGMList(){
        $letters=InComingLetter::orderBy('created_at', 'DESC')->paginate(10);
        $actionTaken=InComingLetter::whereNotNull('action_taker_user_id')->count();
        $projects=Project::all();
        return view('letter.gm_list',['totalLetter'=>$letters->total(),'letters'=>$letters,'actionTaken'=>$actionTaken,'projects'=>$projects]);
    }
    public function storeLetter(Request $request){
        Validator::make($request->all(), [
            'project_name' => 'required',
            'subject' => 'required',
            'ref' => 'required',
            'letter_type' => 'required',
            'department_id' => 'required',
            'letter_path' => 'required|mimes:zip,pdf',
        ]);

        $gm=Users::role('GM')->get();

        //$departments = Department::findOrFail($request->department_id)->name;
        if ($request->letter_path) {
            $file = $request->file('letter_path');
            $file_name = $file->getClientOriginalName();
            $path = $file->store('public/');

        }

        InComingLetter::create([
            'subject' => $request->input('subject'),
            'project_id' => $request->project_id,
            'ref_no' => $request->ref,
            'uploader_user_id' => auth()->user()->id,
            'file_path' => $path,
            'file_name' => $file_name,
            'remark' => $request->remark,
            'gm_id'=>$gm->first()->id,
        ]);
        $message = 'Letter is created By ' . auth()->user()->name;
        $gm->first()->notify(new LetterNotification($message));
        return redirect()->route('letter.list')->with('success', 'Letter is Stored successfully');
    }
    public function download($id){
        $letter = InComingLetter::findOrFail($id);
        $path=storage_path("app/{$letter->file_path}");
        return response()->file($path);
    }

    public function editLetter($id){
        $letter=InComingLetter::findOrFail($id);
        $projects=Project::all();
        if ($letter->uploader()->first()->id == auth()->user()->id) {
            return view('letter.edit_letter', compact('letter','projects'));
        }
        return redirect()->route('letter.list')->with('error', 'unauthorize action you can\'t edit ');
    }
    public function updateSecretary(Request $request,$id){
        $letter=InComingLetter::findOrFail($id);
        $userNotified=users::role('GM')->first();
        if ($request->letter_path) {
            $file = $request->file('letter_path');
            $file_name = $file->getClientOriginalName();
            $path = $file->store('public/storage');
            $letter->file_path = $path;
            $letter->file_name = $file_name;
        }
        $letter->subject = $request->input('subject');
        $letter->project_name = $request->project_name;
        $letter->ref_no = $request->ref;
        $letter->letter_type = $request->letter_type;
        $letter->remark = $request->remark;
        $letter->save();
        $message = 'Letter is updated By ' . auth()->user()->name;
        $userNotified->notify(new LetterNotification($message));
        return redirect('/letter/list')->with('success','letter is updated successfully');
    }
    public function showDetail($id){
        $letter=InComingLetter::findOrFail($id);
        $teams=[];
        $departments = Department::all();
        if($letter->gm_created_at != null){
           if(auth()->user()->department->id==$letter->first_department_id){
               $departmentTeam=$letter->firstDepartment->id;
               $teams=Users::where('department_id',$departmentTeam)-> role('Team')->get();
           }elseif(auth()->user()->department->id==$letter->second_department_id) {
               $departmentTeam = $letter->secondDepartment->id;
               $teams = Users::where('department_id', $departmentTeam)->role('Team')->get();
           }
        }


        return view('letter.detail',['letter'=>$letter,'departments'=>$departments,'teams'=>$teams]);
    }
    public function sendLetter(Request $request,$id){
        $message = 'Letter is sent to you from ' . auth()->user()->name;
        $letter=InComingLetter::findOrFail($id);
        if($request->department_id == $request->another_department_id){
            return redirect()->back()->with('error','You have selected the same department. try again!');
        }
        if($request->department_id != null){
            $depUsers=Department::where('id',$request->department_id)->get();
            foreach($depUsers as $user){
                foreach($user->users as $finalUser){
                    if($finalUser->hasRole('Head|Team Leader')){
                        $finalUser->notify(new LetterNotification($message));
                    };
                }
            }
            $letter->first_department_id=$request->department_id;
        }

        if($request->another_department_id){
            $anotherDepUser=Department::where('id',$request->another_department_id)->get();
            foreach($anotherDepUser as $user){
                foreach($user->users as $finalUser){
                    if($finalUser->hasRole('Head|Team Leader')){
                        $finalUser->notify(new LetterNotification($message));
                    };
                }
            }
        }
        $letter->gm_description=$request->description;

//        $letter->departments()->attach($request->department_id);

        if($request->another_department_id){
//           $letter->departments()->attach($request->another_department_id);
            $letter->second_department_id=$request->another_department_id;
        }
        $letter->gm_created_at=now();
        $letter->save();
        return redirect('/letter/gm/list')->with('success','Letter is sent to department');
    }
    public function showManage(){
        $projects=Project::all();

        $letters=InComingLetter::where('first_department_id',auth()->user()->department->id)->orWhere('second_department_id',auth()->user()->department->id)->orderBy('created_at', 'DESC')->paginate(10);

        $actionTaken=InComingLetter::whereNotNull('action_taker_user_id')->count();
        return view('letter.letter_list',['totalLetter'=>count($letters),'letters'=>$letters,'actionTaken'=>$actionTaken,'projects'=>$projects]);
    }
    public function depSendLetter(Request $request,$id){
        $letter=InComingLetter::findOrFail($id);

        if($request->other_head_description != null){
            $user=Users::findOrFail($request->other_team_id);
            $letter->other_department_user=auth()->user()->id;
            $letter->other_action_taker_user_id=$user->id;
            $letter->other_head_description=$request->other_head_description;
            $letter->other_dept_created_at=now();
            $letter->save();
            $message = 'Letter is sent to you from ' . auth()->user()->name;
            $user->notify(new LetterNotification($message));
            return redirect('/letter/dp')->with('success','Letter is sent to '.$user->name);
        }elseif ($request->head_description != null){
            $user=Users::findOrFail($request->team_id);
            $letter=InComingLetter::findOrFail($id);
            $letter->department_user=auth()->user()->id;
            $letter->action_taker_user_id=$user->id;
            $letter->head_description=$request->head_description;
            $letter->dept_created_at=now();
            $letter->save();
            $message = 'Letter is sent to you from ' . auth()->user()->name;
            $user->notify(new LetterNotification($message));
            return redirect('/letter/dp')->with('success','Letter is sent to '.$user->name);
        }

    }
    public function teamLetters(){
        $projects=Project::all();
        $user=auth()->user();
        $letters=InComingLetter::where('action_taker_user_id',$user->id)->orWhere('other_action_taker_user_id',$user->id)->orderBy('created_at', 'DESC')->paginate(10);

        return view('letter.letter_list',['letters'=>$letters,'projects'=>$projects]);
    }
    public function teamDescription(Request $request,$id){
        Validator::make($request->all(), [
            'team_description'=>'required'
        ]);
        $letter=InComingLetter::findOrFail($id);
        $letter->team_description=$request->team_description;
        $letter->save();
        return redirect('/letter/team/letters')->with('success','your action is saved');
    }
    public function teamSecondDescription(Request $request,$id){

        Validator::make($request->all(), [
            'other_team_description'=>'required'
        ]);
        $letter=InComingLetter::findOrFail($id);
        $letter->other_team_description=$request->other_team_description;
        $letter->save();
        return redirect('/letter/team/letters')->with('success','your action is saved');
    }
}
