@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card shadow p-5 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-dark">{{$pending + $approved }}</h3>
                            <!-- <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p> -->
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-primary ">
                            <span class="mdi mdi-account-multiple icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Users</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card shadow p-5 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-dark ">{{$approved}}</h3>

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-account-multiple icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Approved Users</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card shadow p-5 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-dark">{{$pending}}</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-warning">
                            <span class="mdi mdi-account-multiple icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Pending Users</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card shadow p-5 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-dark">{{$rejected}}</h3>

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-danger ">
                            <span class="mdi mdi-account-multiple icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Rejected Users</h6>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card shadow p-5 mb-5 bg-white rounded">
        <div class="card-body">
            <h4 class="card-title text-dark">All Users</h4>

            </p>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-muted"> # </th>
                            <th class="text-muted"> First name </th>
                            <th class="text-muted"> Department </th>
                            <th class="text-muted"> Role </th>
                            <th class="text-muted"> Status </th>
                            <th class="text-muted"> Permission </th>
                            <th class="text-muted">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="py-1 text-muted">
                                {{ $loop->iteration + $users->firstItem() - 1 }}
                            </td>
                            <td class="text-muted">{{$user->name}} </td>
                            <td>
                                {{$user->department()->first()->name}}
                            </td>
                            <td class="text-muted">{{$user->getRoleNames()}}</td>
                            <td class="text-muted">
                                @if($user->approved==2)
                                <label class="badge badge-danger">rejected</label>
                                @elseif($user->approved==1)
                                <label class="badge badge-success">approved</label>
                                @else
                                <label class="badge badge-warning">pending</label>
                                @endif
                            </td>
                            <td class="text-muted">
                                @foreach($user->getDirectPermissions() as $permission)
                                <p class="text-dark ">{{$permission->name}}</p>
                                @endforeach
                            </td>

                            <td>

                                <a type="button" href="{{ route('admin.edit_user',['id'=>$user->id ])}}" class="btn btn-success">Edit</a>
                                <a type="button" href="{{ route('admin.delete_user',['id'=>$user->id ])}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$users->links()}}
            </div>
        </div>
    </div>
</div>
@endsection