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

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-account-multiple icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Approved letter Request</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card shadow p-5 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-warning">
                            <span class="mdi mdi-account-multiple icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Pending letter Request</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card shadow p-5 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-danger ">
                            <span class="mdi mdi-account-multiple icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Rejected letter Request</h6>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card shadow p-5 mb-5 bg-white rounded">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title text-dark">All letter Request</h4>
                </div>
            </div>



            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-muted"> # </th>
                            <th class="text-muted"> Project Name </th>
                            <th class="text-muted"> Subject </th>
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
                                    {{ $loop->iteration + $letters->firstItem() - 1 }}
                                </td>
                                <td class="text-muted">{{$letter->project_name}} </td>
                                <td>
                                    {{$letter->subject}}
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
                {{$letters->links()}}
            </div>
        </div>
    </div>
</div>
@endsection