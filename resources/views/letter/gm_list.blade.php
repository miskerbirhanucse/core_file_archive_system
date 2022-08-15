@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<div class="row">
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card shadow p-5 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-dark">{{$totalLetter}}</h3>
                            <!-- <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p> -->
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-primary ">
                            <span class="mdi mdi-account-multiple icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total letters</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card shadow p-5 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0 text-dark"> {{$totalLetter-$actionTaken}}</h3>

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-account-multiple icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">On Process Letter</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card shadow p-5 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0 text-dark">  {{$actionTaken}}</h3>

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-warning">
                            <span class="mdi mdi-account-multiple icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Action Taken</h6>
            </div>
        </div>
    </div>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card shadow p-5 mb-5 bg-white rounded">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title text-dark">All Incoming letters </h4>
                </div>
                <form id="incoming" action="{{route('incoming.search')}}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="project_id" class="form-control bg-white border-info text-dark" required>4
                                    <option class="form-control bg-white text-dark" value="">Select project</option>
                                    @foreach($projects as $project)
                                        <option value="{{$project->id}}">{{$project->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3" style="margin-right: 30px;">
                                <input class="border-info text-dark" name="subject" placeholder="Search by subject"/>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>



            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-muted"> # </th>
                            <th class="text-muted"> Project Name </th>
                            <th class="text-muted"> Subject </th>
                            <th class="text-muted"> Action Taken</th>
                            <th class="text-muted"> Uploaded User </th>
                            <th class="text-muted"> Uploaded Time</th>
                            <th class="text-muted">Action</th>

                        </tr>
                    </thead>
                    <tbody>

                            @csrf
                            @foreach($letters as $letter)
                            <tr>
                                <td class="py-1 text-muted">

                                        {{$loop->iteration }}

                                </td>

                                <td class="text-muted">{{$letter->project->name}} </td>
                                <td>
                                    {{$letter->subject}}
                                </td>
                                <td class="">
                                    @if($letter->gm_created_at != null)
                                        <input type="checkbox" class="border-info"   checked/>
                                    @else
                                        <input type="checkbox"  />
                                    @endif

                                </td>
                                <td class="text-muted">{{$letter->uploader->name}}</td>

                                <td class="text-muted">
                                {{$letter->created_at->diffForHumans()}}
                                </td>

                                <td>
                                    <a type="button" href="{{ route('letter.detail',['id'=>$letter->id ])}}" class="btn btn-primary" title="Detail">Detail</a>
                                    <a type="button" href="{{ route('letter.delete',['id'=>$letter->id ])}}" class="btn btn-danger" title="Delete">Delete</a>
                                    <a type="button" href="{{route('letter.download',['id'=>$letter->id])}}" class="btn btn-primary" title="Download" data-toggle="tooltip">download</a>

                                </td>

                            </tr>
                            @endforeach

                    </tbody>
                </table>
                @if(!is_array($letters))
                    {{$letters->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
