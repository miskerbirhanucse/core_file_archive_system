@extends('layouts.main')

@section('content')
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<div class="col-12 grid-margin stretch-card">
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body ">
            <h4 class="card-title text-dark display-4">Edit File Archive Form</h4>
            <form class="forms-sample" method="POST" action="{{ route('archive.update',['id'=>$archive->id])}}">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1" class="text-dark font-weight-bold">Department</label>
                    <select name="department_id" class="form-control bg-white text-dark" required>
                        <option class="form-control bg-white text-dark" value="">Select</option>
                        @foreach($departments as $department)
                        <option value="{{$department->id}}" {{$archive->department_id==$department->id?'selected':''}}>{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1" class="text-dark font-weight-bold">Project</label>
                    <select name="project_id" class="form-control bg-white text-dark" required>
                        <option class="form-control bg-white text-dark" value="">Select</option>
                        @foreach($projects as $project)
                            <option value="{{$project->id}}" {{$archive->project_id==$project->id?'selected':''}}>{{$project->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Subject</label>
                    <textarea class="form-control bg-white text-dark" name="subject" id="exampleTextarea1" rows="4" required>{{$archive->subject}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Ref</label>
                    <input value="{{$archive->ref_no}}" type="text" class="form-control bg-white text-dark" name="ref" id="exampleInputName1" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">File Type</label>

                    <select name="file_type" class="form-control bg-white text-dark" required>
                        <option class="form-control bg-white text-dark" value="">Select</option>

                        <option value="Technical Proposal" {{$archive->file_type =="Technical Proposal"?'selected':''}}>Technical Proposal</option>
                        <option value="Cost Estimate" {{$archive->file_type =="Cost Estimate"?'selected':''}}>Cost Estimate</option>
                        <option value="In going Letter" {{$archive->file_type =="In going Letter"?'selected':''}}>In going Letter</option>
                        <option value="Out going Letter" {{$archive->file_type =="Out going Letter"?'selected':''}}>Out going Letter</option>
                        <option value="Report" {{$archive->file_type =="Report"?'selected':''}}>Report</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Report Type</label>
                    <input type="text" value="{{$archive->report_type}}" class="form-control bg-white text-dark" name="report_type" id="exampleInputName1" placeholder="">
                </div>


                <button type="submit" class="btn btn-primary mr-2">Update</button>

            </form>
        </div>
    </div>
</div>

@endsection
