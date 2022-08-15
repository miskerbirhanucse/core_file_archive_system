@extends('layouts.main')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body ">
            <h4 class="card-title text-dark display-4">Edit Project Form</h4>
            <form class="forms-sample" method="POST" action="{{ route('project.update',['id'=>$project->id])}}">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1" class="text-dark font-weight-bold">Department</label>
                    <select name="department_id" class="form-control bg-white text-dark" required>
                        <option class="form-control bg-white text-dark" value="">Select</option>
                         @foreach($departments as $department)
                        <option value="{{$department->id}}" {{$project->department_id == $department->id ?'selected':''}}>{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1" class="text-dark font-weight-bold">Project Name</label>
                    <input class="form-control bg-white text-dark" name="project_name" value="{{$project->name}}" id="exampleTextarea1"/>
                </div>



                <button type="submit" class="btn btn-primary mr-2">Update</button>

            </form>
        </div>
    </div>
</div>
@endsection