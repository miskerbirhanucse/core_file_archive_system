<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\OutGoingLetter;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;

class OutGoingLetterController extends Controller
{

    public function showCreatePage()
    {
        $projects = Project::all();
        $departments = Department::all();
        return view('outgoing_letters.create_letter', ['projects' => $projects, 'departments' => $departments]);
    }

    public function storeLetter(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'project_id' => 'required',
            'subject' => 'required',
            'ref' => 'required',
            'department_id' => 'required',
            'letter_path' => 'required|mimes:zip,pdf',
        ]);


        $departments = Department::findOrFail($request->department_id)->name;
        $projectName = Project::findOrFail($request->project_id)->project_id;
        $pathForOutgoingLetter = $departments . '/' . 'outgoingLetter' . '/' . $projectName . '/' . $request->subject;
        if ($request->letter_path) {
            $file = $request->file('letter_path');
            $file_name = $file->getClientOriginalName();
            // $path = $file->store('public/storage');
            //  $path=Storage::disk('local')->put($projectName,$file,$file_name);
            $path = $file->storeAs($pathForOutgoingLetter, $file->getClientOriginalName() . '.' . $file->extension());

        }

        OutGoingLetter::create([
            'subject' => $request->input('subject'),
            'project_id' => $request->project_id,
            'ref_no' => $request->ref,
            'uploader_user_id' => auth()->user()->id,
            'file_path' => $path,
            'file_name' => $file_name,
            'department_id' => $request['department_id'],
            'remark' => $request->remark,
        ]);
        return redirect()->route('outGoing.department')->with('success', 'File is Stored successfully');
    }

    public function outGoingLists()
    {
        $projects = Project::all();
        $letters = OutGoingLetter::orderBy('subject')->paginate(10);
        return view('outgoing_letters.list', ['letters' => $letters, 'projects' => $projects]);
    }

    public function departmentOutGoingList()
    {
        $projects = Project::all();
        $letters = OutGoingLetter::where('department_id', auth()->user()->department_id)->orWhere('uploader_user_id', auth()->user()->id)->orderBy('subject')->paginate(10);
        return view('outgoing_letters.list', ['letters' => $letters, 'projects' => $projects]);
    }

    public function download($id)
    {
        $letter = OutGoingLetter::findOrFail($id);
        return Storage::download($letter->file_path, $letter->file_name);
    }

    public function editLetter($id)
    {
        $letter = OutGoingLetter::findOrFail($id);
        $projects = Project::all();
        $departments = Department::all();
        if ($letter->uploader()->first()->id == auth()->user()->id) {
            return view('outgoing_letters.edit', compact('letter', 'projects', 'departments'));
        }
        return redirect()->route('outGoing.list')->with('error', 'unauthorize action you can\'t edit ');
    }

    public function updateLetter(Request $request, $id)
    {
        $letter = OutGoingLetter::findOrFail($id);

        $departments = Department::findOrFail($request->department_id)->name;
        $projectName = Project::findOrFail($request->project_id)->project_id;
        $pathForOutgoingLetter = $departments . '/' . 'outgoingLetter' . '/' . $projectName . '/' . $request->subject;
        if ($request->letter_path) {
            $file = $request->file('letter_path');
            $file_name = $file->getClientOriginalName();
            // $path = $file->store('public/storage');
            //  $path=Storage::disk('local')->put($projectName,$file,$file_name);
            $path = $file->storeAs($pathForOutgoingLetter, $file->getClientOriginalName() . '.' . $file->extension());

        }
        $letter->subject = $request->input('subject');
        $letter->project_id = $request->project_id;
        $letter->ref_no = $request->ref;
        $letter->remark = $request->remark;
        $letter->file_path = $path;
        $letter->file_name = $file_name;
        $letter->save();

        return redirect()->route('outGoing.department')->with('success', 'letter is updated successfully');
    }
    public function deleteOutGoingLetter($id)
    {
        $outGoingLetter = OutGoingLetter::findOrFail($id);
        if ($outGoingLetter) {
            $outGoingLetter->delete();
            return redirect()->route('outGoing.all')->with('success', 'OutGoing Letter is deleted successfully');
        }
        return redirect()->route('outGoing.all')->with('error', 'unauthorize action you can\'t delete this file');
    }
}
