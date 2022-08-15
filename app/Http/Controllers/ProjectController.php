<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProjectController extends Controller
{
    public function createProject(){
        $departments=Department::all();
        return view('project.create_project',['departments' => $departments]);
    }
    public function projectList(){
        $projects=Project::orderBy('name')->paginate(10);
        return view('project.project_list',['projects'=>$projects]);
    }
    public function editProject($id){
        $project=Project::findOrFail($id);
        $departments=Department::all();
        if($project){
            return view('project.edit_project',['project'=>$project,'departments' => $departments]);
        }
        return redirect()->route('project.list')->with('failed', 'Project is not created');
    }
    public function updateProject(Request $request,$id){
        $project=Project::findOrFail($id);
        $project->name=$request->project_name;
        $project->department_id=$request->department_id;
        $project->save();
        if($project){
            return redirect()->route('project.list')->with('success', 'Project is updated successfully');
        }
        $departments=Department::all();
        return view('project.edit_project',['project'=>$project,'departments' => $departments])->with('failed', 'Project is not created');
    }
    public function storeProject(Request $request){
        Validator::make($request->all(),[
            'project_name'=>'required',
            'department_id'=>'required',
        ]);
        $result=Project::create([
            'name'=>$request->project_name,
            'department_id'=>$request->department_id,
        ]);
        if($result){
            return redirect()->route('project.list')->with('success', 'Project is created successfully');
        }
         return redirect()->route('project.list')->with('failed', 'Project is not created');
    }
    public function deleteProject($id){
        $project=Project::findOrFail($id)->delete();
        if($project){
             return redirect()->route('project.list')->with('success', 'Project is deleted successfully');
        }
         return redirect()->route('project.list')->with('failed', 'Project is not found');
    }
}
