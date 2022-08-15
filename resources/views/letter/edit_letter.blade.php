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
            <h4 class="card-title text-dark display-4">Update Letter Form</h4>
            <form id="fileUploadForm" class="forms-sample" enctype="multipart/form-data" method="POST" action="{{ route('letter.update.secretary',['id'=>$letter->id])}}">
                @method('put')
                @csrf
               <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Project Name</label>
                    <select name="project_id"  class="form-control bg-white text-dark" required>
                        <option class="form-control bg-white text-dark">Select</option>
                         @foreach($projects as $project)
                          <option value="{{$project->id}}"{{$letter->project_id==$letter->id?'selected':''}}>{{$project->name}}</option>
                         @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Subject</label>
                    <textarea class="form-control bg-white text-dark" name="subject" id="exampleTextarea1" rows="4" required>{{$letter->subject}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Ref No</label>
                    <input type="text" class="form-control bg-white text-dark" name="ref" id="exampleInputName1"value="{{$letter->ref_no}}" placeholder="" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Remark(optional) </label>
                    <textarea type="text" class="form-control bg-white text-dark" name="remark" id="exampleInputName1" placeholder="">{{$letter->remark}}</textarea>
                </div>
                <div class="form-group">
                    @error('letter_path')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <label for="" class="text-dark font-weight-bold">Select The File</label>
                    <input type="file" name="letter_path" id="" class="form-control bg-white text-dark" >
                </div>

                    <div class="progress bg-white">
                        <div class="bar"></div>

                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary mr-2">Update Letter</button>
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