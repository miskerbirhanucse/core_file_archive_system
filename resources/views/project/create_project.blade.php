@extends('layouts.main')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body ">
            <h4 class="card-title text-dark display-4">Create Project Form</h4>
            <form class="forms-sample" method="POST" action="{{ route('project.store')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1" class="text-dark font-weight-bold">Department</label>
                    <select name="department_id" class="form-control bg-white text-dark" required>
                        <option class="form-control bg-white text-dark" value="">Select</option>
                        @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1" class="text-dark font-weight-bold">Project Name</label>
                    <input class="form-control bg-white text-dark" name="project_name" id="exampleTextarea1"/>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1" class="text-dark font-weight-bold">Project Id</label>
                    <input class="form-control bg-white text-dark" name="project_id" id="exampleTextarea1"/>
                </div>



                <button type="submit" class="btn btn-primary mr-2">Create</button>

            </form>
        </div>
    </div>
</div>
@endsection