@extends('layouts.main')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body">
            <h4 class="card-title text-dark font-weight-bold display-4" style="text-align: center">Letter Detail</h4>

               <div class="form-group">
                   <p for="exampleInputName1" class="text-dark display-5 ">Uploaded By: <b>{{$letter->uploader->name}} </b></p>
               </div>
            <div class="form-group">
                <p for="exampleInputName1" class="text-dark display-5 ">Department: <b>{{$letter->secretaryAddedDepartment->name}} </b>
                </p>
            </div>
               <div class="form-group">
                   <p for="exampleInputEmail3" class="text-dark display-5 ">Project: <b>{{$letter->project->name}}</b></p>

               </div>
            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">Subject:<b> {{$letter->subject}}</b></p>
            </div>
            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">Ref no:<b> {{$letter->ref_no}}</b></p>
            </div>
{{--            <div class="form-group">--}}
{{--                <p for="exampleInputEmail3" class="text-dark display-5">GM Sent to :--}}
{{--                @if($letter->gm_created_at != null)--}}

{{--                        @foreach ($letter->departments as $department)--}}
{{--                           <b>{{ $department->name}}</b>,<br>--}}
{{--                        @endforeach--}}
{{--                    @else--}}
{{--                    <b>Not sent yet</b>--}}
{{--                    @endif--}}
{{--                </p>--}}
{{--            </div>--}}

            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">General Manager Description:
                    @if($letter->gm_description != null)
                        <b>{{$letter->gm_description}}</b>
                    @else
                        <b>No description</b>
                    @endif
                </p>
            </div>

            <div class="row justify-content-between m-5">
                @if($letter->first_department_id !=null)
                <div>
                    <h4 class="text-dark display-5 pb-3">{{$letter->first_department_id != null ? $letter->firstDepartment()->first()->name : "not assigned for department"}}</h4>
                    <div class="form-group">
                        <p for="exampleInputEmail3" class="text-dark display-5">Department User Name :
                            @if($letter->department_user != null)
                                <b>{{$letter->departmentUser->name }}</b>
                            @else
                                <b>No head is assigned</b>
                            @endif
                        </p>
                    </div>
                    <div class="form-group">
                        <p for="exampleInputEmail3" class="text-dark display-5">Department Description:
                            @if($letter->head_description != null)
                                <b>{{$letter->head_description}}</b>
                            @else
                                <b>No description</b>
                            @endif
                        </p>
                    </div>

                    <div class="form-group">
                        <p for="exampleInputEmail3" class="text-dark display-5">Action Taker Name:
                            @if($letter->action_taker_user_id != null)
                                <b>{{$letter->actionTaker->name}}</b>
                            @else
                                <b>No Action Taker is assigned</b>
                            @endif
                        </p>
                    </div>
                    <div class="form-group">
                        <p for="exampleInputEmail3" class="text-dark display-5">Team Description:
                            @if($letter->team_description != null)
                                <b>{{$letter->team_description }}</b>
                            @else
                                <b>No description</b>
                            @endif
                        </p>
                    </div>
                </div>
                @else
                    <div>
                        <p class="text-dark display-5">Not assigned for department</p>
                    </div>
                @endif
                <div style="width: 2px;height: 180px;border-left:2px solid black;">
                </div>
                @if($letter->second_department_id !=null)
                    <div>
                        <h4 class="text-dark display-5 pb-3">{{$letter->second_department_id != null ? $letter->secondDepartment()->first()->name : "not assigned yet"}}</h4>
                        <div class="form-group">
                            <p for="exampleInputEmail3" class="text-dark display-5">Department User Name :
                                @if($letter->other_department_user != null)
                                    <b>{{$letter->otherDepartmentUser->name }}</b>
                                @else
                                    <b>No head is assigned</b>
                                @endif
                            </p>
                        </div>
                        <div class="form-group">
                            <p for="exampleInputEmail3" class="text-dark display-5">Department Description:
                                @if($letter->other_head_description != null)
                                    <b>{{$letter->other_head_description}}</b>
                                @else
                                    <b>No description</b>
                                @endif
                            </p>
                        </div>

                        <div class="form-group">
                            <p for="exampleInputEmail3" class="text-dark display-5">Action Taker Name:
                                @if($letter->other_action_taker_user_id != null)
                                    <b>{{$letter->otherActionTaker->name}}</b>
                                @else
                                    <b>No Action Taker is assigned</b>
                                @endif
                            </p>
                        </div>
                        <div class="form-group">
                            <p for="exampleInputEmail3" class="text-dark display-5">Team Description:
                                @if($letter->other_team_description != null)
                                    <b>{{$letter->other_team_description }}</b>
                                @else
                                    <b>No description</b>
                                @endif
                            </p>
                        </div>
                    </div>
                @else
                    <div>
                        <p class="text-dark display-5">Not assigned for other department</p>
                    </div>
                @endif
            </div>
            @hasrole('GM')
            <form action="{{ route('letter.gm.send',['id'=>$letter->id ])}}" method="POST" id="approve">
                @csrf
                {{method_field('PUT')}}
                <div class="form-group" style="display:flex;">
                    <p for="exampleInputEmail3" style="padding-right: 50px;" class="text-dark display-5">Send to </p>
                    <select name="department_id" class="form-select bg-white text-dark" >
                        <option class=" bg-white text-dark" value="">Select department</option>
                        @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="display:flex;">
                    <p for="exampleInputEmail3" style="padding-right: 50px;" class="text-dark display-5">Send to another department </p>
                    <select name="another_department_id" class="form-select bg-white text-dark" >
                        <option class=" bg-white text-dark" value="">Select another department</option>
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
            @hasanyrole('Head|Team Leader ')
            @if(auth()->user()->department->id==$letter->first_department_id)
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
            @endif
            @endhasanyrole
            @hasanyrole('Head|Team Leader ')
            @if(auth()->user()->department->id==$letter->second_department_id)
            <form action="{{ route('dp.letter',['id'=>$letter->id ])}}" method="POST" >
                {{method_field('PUT')}}
                @csrf
                <div class="form-group" style="display:flex;">
                    <p for="exampleInputEmail3" style="padding-right: 50px;" class="text-dark display-5">Send to </p>
                    <select class="form-group" name="other_team_id" class="form-select bg-white text-dark" required>
                        <option class=" bg-white text-dark" value="">Select</option>
                        @foreach($teams as $team)
                            <option value="{{$team->id}}">{{$team->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <p for="exampleInputName1" class="text-dark display-5">Description</p>
                    <textarea class="form-control bg-white text-dark" name="other_head_description" id="exampleTextarea1" rows="4" ></textarea>
                </div>
                <button type="submit" class="btn btn-primary mr-2 mt-5">Send</button>
            </form>
            @endif
            @endhasanyrole
            @hasrole('Team')
            @if(auth()->user()->department->id==$letter->first_department_id)
            <form action="{{ route('first.description',['id'=>$letter->id ])}}" method="POST" >
                {{method_field('PUT')}}
                @csrf
                <div class="form-group">
                    <p for="exampleInputName1" class="text-dark display-5">Team Description</p>
                    <textarea class="form-control bg-white text-dark" name="team_description" id="exampleTextarea1" rows="4" ></textarea>
                </div>
                <button type="submit" class="btn btn-primary mr-2 mt-2">Send</button>
            </form>
            @endif
            @endrole
            @hasrole('Team')
            @if(auth()->user()->department->id==$letter->second_department_id)
            <form action="{{ route('team.second.description',['id'=>$letter->id ])}}" method="POST" >
                {{method_field('PUT')}}
                @csrf
                <div class="form-group">
                    <p for="exampleInputName1" class="text-dark display-5">Team Description</p>
                    <textarea class="form-control bg-white text-dark" name="other_team_description" id="exampleTextarea1" rows="4" ></textarea>
                </div>
                <button type="submit" class="btn btn-primary mr-2 mt-2">Send</button>
            </form>
            @endif
            @endrole
        </div>
    </div>
</div>
@endsection
