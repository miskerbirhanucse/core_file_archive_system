<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\User;
use App\Models\Department;
use App\Notifications\LetterNotification;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class LetterController extends Controller
{
    //
    public function showCreatePage(){
        return view('letter.create_letter');
    }
    public function showListPage(){
        $letters=Letter::where('uploader_user_id',auth()->user()->id)->orderBy('project_name')->paginate(10);
        return view('letter.letter_list',compact('letters'));
    }
    public function showGMList(){
        $letters=Letter::orderBy('created_at', 'DESC')->paginate(10);
        return view('letter.gm_list',['totalLetter'=>$letters->total(),'letters'=>$letters]);
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

        $gm=User::role('GM')->get();

        //$departments = Department::findOrFail($request->department_id)->name;
        if ($request->letter_path) {
            $file = $request->file('letter_path');
            $file_name = $file->getClientOriginalName();
            $path = $file->store('public/');

        }

        Letter::create([
            'subject' => $request->input('subject'),
            'project_name' => $request->project_name,
            'ref_no' => $request->ref,
            'letter_type' => $request->letter_type,
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
        $letter = Letter::findOrFail($id);
        $path=storage_path("app/{$letter->file_path}");
        return response()->file($path);
    }
    public function adminSearch(Request $request)
    {

        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');

            if ($query != '') {
                $dataDB = FileArchive::where('project_name', 'like', '%' . strtolower($query) . '%')->paginate(10);
            } else {
                $dataDB = FileArchive::paginate(10);
            }

            $total_row = $dataDB->count();
            if ($total_row > 0) {
                foreach ($dataDB as $loop => $archive) {
                    $output .= '
            <tr>
             <td>' .  $loop->iteration + $dataDB->firstItem() - 1 . '</td>
             <td>' . $archive->department->name . '</td>
             <td>' . $archive->file_type . '</td>
             <td>' . $archive->project_name . '</td>
             <td>' . $archive->subject  . '</td>
             <td>' . $archive->ref_no . '</td>
             <td>
             <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
             <a class="delete" title="Delete" data-toggle="tooltip" href=' .  route("archive.delete", ["id" => $archive->id]) . ' ><i class="material-icons">&#xE872;</i></a>
             <a  class="download" title="Download" data-toggle="tooltip"href=' . route('archive.download', ['file' => $archive->id]) . '><i class="material-icons">&#xe2c4;</i></a>
             </td>
            </tr>
            ';
                }
            } else {
                $output = '
           <tr>
             <td align="center" colspan="5">No Data Found</td>
           </tr>
           ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );
            return \Response::json($data);
        }
    }
    public function editLetter($id){
        $letter=Letter::findOrFail($id);
        if ($letter->uploader()->first()->id == auth()->user()->id) {
            return view('letter.edit_letter', compact('letter'));
        }
        return redirect()->route('letter.list')->with('error', 'unauthorize action you can\'t edit the purchase');
    }
    public function updateSecretary(Request $request,$id){
        $letter=Letter::findOrFail($id);
        $userNotified=User::role('GM')->first();
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
        $letter=Letter::findOrFail($id);
        $departments = Department::all();
        $teams=User::role('Team')->get();
        return view('letter.detail',['letter'=>$letter,'departments'=>$departments,'teams'=>$teams]);
    }
    public function sendLetter(Request $request,$id){
        $message = 'Letter is sent to you from ' . auth()->user()->name;
        $depUsers=Department::where('id',$request->department_id)->get();
        foreach($depUsers as $user){
            foreach($user->users as $finalUser){
              if($finalUser->hasRole('Head|Team Leader')){
                $finalUser->notify(new LetterNotification($message));
              };
            }
        }
        $letter=Letter::findOrFail($id);
        $letter->description=$request->description;
        $letter->department_id=$request->department_id;
        $letter->gm_created_at=now();
        $letter->save();
        return redirect('/letter/gm/list')->with('success','Letter is sent to department');
    }
    public function showManage(){
        $letters=Letter::where('department_id',auth()->user()->department->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('letter.gm_list',['totalLetter'=>$letters->total(),'letters'=>$letters]);
    }
    public function depSendLetter(Request $request,$id){
        $user=User::findOrFail($request->team_id);
        $letter=Letter::findOrFail($id);
        $letter->department_user=auth()->user()->id;
        $letter->action_taker_user_id=$user->id;
        $letter->head_description=$request->head_description;
        $letter->dept_created_at=now();
        $letter->save();
        $message = 'Letter is sent to you from ' . auth()->user()->name;
        $user->notify(new LetterNotification($message));
        return redirect('/letter/manage')->with('success','Letter is sent to '.$user->name);
    }
    public function teamLetters(){
        $user=auth()->user();
        $letters=Letter::where('action_taker_user_id',$user->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('letter.letter_list',['letters'=>$letters]);
    }
}
