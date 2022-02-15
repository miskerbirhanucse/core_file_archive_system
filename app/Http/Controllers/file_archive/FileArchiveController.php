<?php

namespace App\Http\Controllers\file_archive;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\FileArchive;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDF;

class FileArchiveController extends Controller
{
    //
    public function create()
    {
        $departments = Department::all();
        return view("file_archive.create_file_archive", ['departments' => $departments]);
    }
    public function allArchive()
    {
        $archives = FileArchive::where('user_id', auth()->user()->id)->orderBy('project_name')->paginate(10);
        return view('file_archive.archive_list', compact('archives'));
    }
    public function allArchiveAdmin()
    {
        $archives = FileArchive::paginate(10);
        return view('admin.all_archive_page', compact('archives'));
    }
    public function deleteArchive($id)
    {
        $archive = FileArchive::findOrFail($id);
        if ($archive) {
            $archive->delete();
            return redirect()->route('archive.admin_all')->with('success', 'Archive File is deleted successfully');
        }
        return redirect()->route('archive.admin_all')->with('error', 'unauthorize action you can\'t delete the purchase');
    }
    public function store(Request $request)
    {
        $version = $request->input('version');

        $validate = Validator::make($request->all(), [
            'project_name' => 'required',
            'subject' => 'required',
            'ref' => 'required',
            'file_type' => 'required',
            'department_id' => 'required',
            'file_path' => 'required|mimes:zip,pdf',
        ]);



        //$departments = Department::findOrFail($request->department_id)->name;
        if ($request->file_path) {
            $file = $request->file('file_path');
            $file_name = $file->getClientOriginalName();
            $path = $file->store('public/storage');
        }

        FileArchive::create([
            'subject' => $request->input('subject'),
            'project_name' => $request->project_name,
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
    // public function search(Request $request)
    // {

    //     if ($request->ajax()) {
    //         $output = '';
    //         $query = $request->get('query');

    //         if ($query != '') {
    //             $dataDB = FileArchive::where('project_name', 'like', '%' . strtolower($query) . '%')->paginate(10);
    //         } else {
    //             $dataDB = FileArchive::where('department_id', auth()->user()->department_id)->paginate(10);
    //         }

    //         $total_row = $dataDB->count();
    //         if ($total_row > 0) {
    //             foreach ($dataDB as $loop => $archive) {
    //                 $output .= '
    //         <tr>
    //          <td>' . $dataDB->firstItem() . '</td>
    //          <td>' . $archive->department->name . '</td>
    //          <td>' . $archive->file_type . '</td>
    //          <td>' . $archive->project_name . '</td>
    //          <td>' . $archive->project_name . '</td>
    //          <td>' . $archive->subject . '</td>
    //          <td>' . $archive->ref_no . '</td>
    //          <td><a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i>
    //          <a  class="download" title="Download" data-toggle="tooltip"href=' . route('archive.download',['file'=>$archive->id ]) . '><i class="material-icons">&#xe2c4;</i></a>  </td>
    //         </tr>
    //         ';
    //             }
    //         } else {
    //             $output = '
    //        <tr>
    //          <td align="center" colspan="5">No Data Found</td>
    //        </tr>
    //        ';
    //         }
    //         $data = array(
    //             'table_data'  => $output,
    //             'total_data'  => $total_row
    //         );
    //         return \Response::json($data);
    //     }
    // }
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
    public function editArchive($id)
    {
        $archive = FileArchive::findOrFail($id);
        $departments = Department::all();
        return view('file_archive.edit_archive',  ['departments' => $departments, 'archive' => $archive]);
    }
    public function updateArchive(Request $request, $id)
    {
        $archive = FileArchive::findOrFail($id);

        $archive->subject = $request->input('subject');
        $archive->project_name = $request->project_name;
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
        $month = $request->month;
        $currentTime = Carbon::now()->isoFormat('DD/MMM/YYYY');
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();

            $archives = FileArchive::whereBetween('created_at', [$start_date, $end_date])->paginate(10);
        }
        if ($archives->total() != 0) {
            $pdf = PDF::loadView('file_archive.archive_report', ['archives' => $archives, 'month' => $month, 'currentTime' => $currentTime])->setPaper('a4', 'landscape');
            set_time_limit(300);
            // download PDF file with download method
            return $pdf->stream('pdf_file.pdf');
        } else {
            return redirect()->route('show.archive.report')->with('error', 'No file is archived in provided date');
        }
    }
}
