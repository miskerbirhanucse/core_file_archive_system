@extends('layouts.main')

@section('content')
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<div class="col-12 grid-margin stretch-card">
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body ">
            <h4 class="card-title text-dark display-4">Edit File letter Form</h4>
            <form class="forms-sample" method="POST" enctype="multipart/form-data" action="{{ route('outGoing.update',['id'=>$letter->id])}}">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1" class="text-dark font-weight-bold">Department</label>
                    <select name="department_id" class="form-control bg-white text-dark" required>
                        <option class="form-control bg-white text-dark" value="">Select</option>
                        @foreach($departments as $department)
                        <option value="{{$department->id}}" {{$letter->
                            department_id==$department->id?'selected':''}}>{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1" class="text-dark font-weight-bold">Project</label>
                    <select name="project_id" class="form-control bg-white text-dark" required>
                        <option class="form-control bg-white text-dark" value="">Select</option>
                        @foreach($projects as $project)
                        <option value="{{$project->id}}" {{$letter->
                            project_id==$project->id?'selected':''}}>{{$project->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Subject</label>
                    <textarea class="form-control bg-white text-dark" name="subject" id="exampleTextarea1" rows="4"
                        required>{{$letter->subject}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Ref</label>
                    <input value="{{$letter->ref_no}}" type="text" class="form-control bg-white text-dark" name="ref"
                        id="exampleInputName1" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Remark(optional) </label>
                    <textarea type="text" class="form-control bg-white text-dark" name="remark" id="exampleInputName1"
                        placeholder="">{{$letter->remark}}</textarea>
                </div>
                <div class="form-group">
                    @error('letter_path')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <label for="" class="text-dark font-weight-bold">Attach file</label>
                    <input type="file" name="letter_path" id="" class="form-control bg-white text-dark" required>
                </div>


                <button type="submit" class="btn btn-primary mr-2">Update</button>

            </form>
        </div>
    </div>
</div>

@endsection
