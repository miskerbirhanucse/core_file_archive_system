<?php

namespace App\Http\Controllers\file_archive;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\FileArchive;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDF;

class FileArchiveController extends Controller
{
    //
    public function create()
    {
        $departments = Department::all();
        $projects=Project::all();
        return view("file_archive.create_file_archive", ['departments'=>$departments,'projects'=>$projects]);
    }
    public function allArchive()
    {
        $projects=Project::all();
        $archives = FileArchive::where('department_id', auth()->user()->department->id)->orderBy('subject')->paginate(10);
        return view('file_archive.archive_list', ['archives'=>$archives,'projects'=>$projects]);
    }
    public function allArchiveAdmin()
    {
        $archives = FileArchive::paginate(10);
        return view('admin.all_archive_page', ['archives'=>$archives]);
    }
    public function deleteArchive($id)
    {
        $archive = FileArchive::findOrFail($id);
        if ($archive) {
            $archive->delete();
            return redirect()->route('archive.admin')->with('success', 'Archive File is deleted successfully');
        }
        return redirect()->route('archive.admin')->with('error', 'unauthorize action you can\'t delete the purchase');
    }
    public function store(Request $request)
    {
        $version = $request->input('version');

        $validate = Validator::make($request->all(), [
            'project_id' => 'required',
            'subject' => 'required',
            'ref' => 'required',
            'file_type' => 'required',
            'department_id' => 'required',
            'file_path' => 'required|mimes:zip,pdf',
        ]);



        $departments = Department::findOrFail($request->department_id)->name;
           $projectName=Project::findOrFail($request->project_id)->project_id;
           $pathForOutgoingLetter=$departments.'/'.'fileArchive'.'/'.$projectName.'/'.$request->subject;
        if ($request->file_path) {
            $file = $request->file('file_path');
            $file_name = $file->getClientOriginalName();
            $path=$file->storeAs($pathForOutgoingLetter,$file->getClientOriginalName().'.'.$file->extension());
        }

        FileArchive::create([
            'subject' => $request->input('subject'),
            'project_id' => $request->project_id,
            'ref_no' => $request->ref,
            'file_type' => $request->file_type,
            'user_id' => auth()->user()->id,
            'file_path' => $path,
            'file_name' => $file_name,
            'report_type' => $request->input('report_type'),
            'department_id' => $request['department_id'],
            'file_version' => $version[0],
        ]);
        return redirect()->route('archive.list')->with('success', 'File is Stored successfully');
    }
    public function download($file)
    {
        $id = FileArchive::findOrFail($file);
        return Storage::download($id->file_path, $id->file_name);
    }

    public function editArchive($id)
    {
        $archive = FileArchive::findOrFail($id);
        $departments = Department::all();
        $projects=Project::all();
        return view('file_archive.edit_archive',  ['departments' => $departments, 'archive' => $archive,'projects'=>$projects]);
    }
    public function updateArchive(Request $request, $id)
    {
        $archive = FileArchive::findOrFail($id);

        $archive->subject = $request->input('subject');
        $archive->project_id = $request->project_id;
        $archive->ref_no = $request->ref;
        $archive->file_type = $request->file_type;
        $archive->report_type = $request->input('report_type');
        $archive->department_id = $request['department_id'];
        $archive->save();
        if (auth()->user()->id == 1) {
            return redirect()->route('archive.admin_all')->with('success', 'File is Updated successfully');
        }
        return redirect()->route('archive.list')->with('success', 'File is Updated successfully');
    }
    public function showReportPage()
    {
        return view('file_archive.generate_report');
    }
    public function reportArchive(Request $request)
    {
        //$month = $request->month;
        $reportMonth =Date::parse($request->start_date)->format('F Y');
        //$reportMonth->format('Y-m');
        //dd();

        $currentTime = Carbon::now()->isoFormat('DD/MMM/YYYY');
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();

            $archives = FileArchive::whereBetween('created_at', [$start_date, $end_date])->paginate(10);
        }
        if ($archives->total() != 0) {
            $pdf = PDF::loadView('file_archive.archive_report', ['archives' => $archives, 'month' => $reportMonth, 'currentTime' => $currentTime])->setPaper('a4', 'landscape');
            set_time_limit(300);
            // download PDF file with download method
            return $pdf->stream('pdf_file.pdf');
        } else {
            return redirect()->route('show.archive.report')->with('error', 'No file is archived in provided date');
        }
    }
    public function searchArchive(Request $request){
        $archives=FileArchive::where('project_id','=',$request->project_id)->where('subject','like', '%'.$request->subject.'%')->paginate(10);
        $projects=Project::all();

        return view('file_archive.archive_list',['archives'=>$archives,'projects'=>$projects]);
    }
}
