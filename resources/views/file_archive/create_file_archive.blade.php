@extends('layouts.main')

@section('content')
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script> -->
<style>
    .progress {
        position: relative;
        width: 100%;
    }

    .bar {
        background-color: #00ff00;
        width: 0%;
        height: 20px;
    }

    .percent {
        position: absolute;
        display: inline-block;
        left: 50%;
        color: #040608;
    }
</style>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<div class="col-12 grid-margin stretch-card">
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body ">
            <h4 class="card-title text-dark display-4">File Archive Form</h4>
            <form id="fileUploadForm" class="forms-sample" enctype="multipart/form-data" method="POST" action="{{ route('archive.store')}}">
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
                    <label for="exampleInputName1" class="text-dark font-weight-bold">Project</label>
                    <select name="project_id" class="form-control bg-white text-dark" required>
                        <option class="form-control bg-white text-dark" value="">Select</option>
                        @foreach($projects as $project)
                        <option value="{{$project->id}}">{{$project->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Subject</label>
                    <textarea class="form-control bg-white text-dark" name="subject" id="exampleTextarea1" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Ref</label>
                    <input type="text" class="form-control bg-white text-dark" name="ref" id="exampleInputName1" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">File Type</label>

                    <select name="file_type" class="form-control bg-white text-dark" required>
                        <option class="form-control bg-white text-dark" value="">Select</option>

                        <option value="Technical Proposal">Technical Proposal</option>
                        <option value="Cost Estimate">Cost Estimate</option>
                        <option value="Report">Report</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Report Type</label>
                    <input type="text" class="form-control bg-white text-dark" name="report_type" id="exampleInputName1" placeholder="">
                </div>
                <div class="form-group">
                    @error('file_path')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <label for="" class="text-dark font-weight-bold">Select The File</label>
                    <input type="file" name="file_path" id="" class="form-control bg-white text-dark" required>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="container">
                            <h6 class="text-dark">File Version</h6>
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-primary">
                                <label class="form-check-label">
                                    <input type="checkbox" name="version[]" class="form-check-input" value="draft">Draft</label>
                            </div>
                            <div class="form-check form-check-success">
                                <label class="form-check-label">
                                    <input type="checkbox" name="version[]" class="form-check-input" value="final">Final</label>
                            </div>
                            <div class="form-check form-check-info">
                                <label class="form-check-label">
                                    <input type="checkbox" name="version[]" class="form-check-input" value="other"> Other</label>
                            </div>

                        </div>
                    </div>
                    <div class="progress bg-white">
                        <div class="bar"></div>

                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary mr-2">Store</button>
                    <!-- <div class="form-group ">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-wight" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                    </div>
                </div> -->
            </form>
        </div>
    </div>
</div>

<script>
    var SITEURL = "{{URL('/')}}";
    $(function() {
        $(document).ready(function() {
            var bar = $('.bar');
            var percent = $('.percent');
            $('form').ajaxForm({
                beforeSend: function() {
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                complete: function(xhr) {
                    alert('File Has Been Uploaded Successfully');
                    // window.location.href = SITEURL + "/" + "upload-form";
                }
            });
        });
    });
</script>
@endsection
