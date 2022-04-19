@extends('layouts.main')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body ">
            <h4 class="card-title text-dark font-weight-bold display-4">Letter Detail</h4>
            <div class="form-group">
                <p for="exampleInputName1" class="text-dark display-5 ">Uploaded By: <b>{{$letter->uploader->name}} </b></p>
            </div>
            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5 ">Project: <b>{{$letter->project_name}}</b></p>

            </div>
            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">Subject:<b> {{$letter->subject}}</b></p>
            </div>
            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">Letter type:<b> {{$letter->letter_type}}</b></p>
            </div>
            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">GM Sent to :
                @if($letter->department != null)
                <b>{{$letter->department->name}}</b>
                    @else
                    <b>Not sent yet</b>
                    @endif
                </p>
            </div>
            @hasanyrole('Head|Team Leader')
            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">Description:
                    @if($letter->description != null)
                        <b>{{$letter->description}}</b>
                    @else
                        <b>No description</b>
                    @endif
                </p>
            </div>
            @endhasanyrole
            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">Department :
                    @if($letter->description != null)
                        <b>{{$letter->description}}</b>
                    @else
                        <b>No description</b>
                    @endif
                </p>
            </div>
            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">Action Taker:
                    @if($letter->action_taker_user_id != null)
                        <b>{{$letter->actionTaker->name}}</b>
                    @else
                        <b>No Action Taker is assigned</b>
                    @endif
                </p>
            </div>
            @hasanyrole('Head|Team Leader')
            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">Department Description:
                    @if($letter->head_description != null)
                        <b>{{$letter->description}}</b>
                    @else
                        <b>No description</b>
                    @endif
                </p>
            </div>
            @endhasanyrole
            @hasrole('GM')
            <form action="{{ route('letter.gm.send',['id'=>$letter->id ])}}" method="POST" id="approve">
                @csrf
                {{method_field('PUT')}}

                <div class="form-group" style="display:flex;">
                    <p for="exampleInputEmail3" style="padding-right: 50px;" class="text-dark display-5">Send to </p>
                    <select name="department_id" class="form-select bg-white text-dark" required>
                        <option class=" bg-white text-dark" value="">Select</option>
                        @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <p for="exampleInputName1" class="text-dark display-5">Description</p>
                    <textarea class="form-control bg-white text-dark" name="description" id="exampleTextarea1" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mr-2 mt-5">Send</button>
            </form>
            @endhasrole
            @hasanyrole('Head|Team Leader')
            <form action="{{ route('dp.letter',['id'=>$letter->id ])}}" method="POST" >
                {{method_field('PUT')}}
                @csrf
                <div class="form-group" style="display:flex;">
                    <p for="exampleInputEmail3" style="padding-right: 50px;" class="text-dark display-5">Send to </p>
                    <select class="form-group" name="team_id" class="form-select bg-white text-dark" required>
                        <option class=" bg-white text-dark" value="">Select</option>
                        @foreach($teams as $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <p for="exampleInputName1" class="text-dark display-5">Description</p>
                    <textarea class="form-control bg-white text-dark" name="head_description" id="exampleTextarea1" rows="4" ></textarea>
                </div>
                <button type="submit" class="btn btn-primary mr-2 mt-5">Send</button>
            </form>
            @endhasanyrole
        </div>
    </div>
</div>
@endsection