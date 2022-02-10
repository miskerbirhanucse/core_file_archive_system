@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card shadow p-5 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-dark">{{$pending+$approved+$rejected}}</h3>
                            <!-- <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p> -->
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-primary ">
                            <span class="mdi mdi-account-multiple icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Purchase Request</h6>
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
                <h6 class="text-muted font-weight-normal">Approved Purchased Request</h6>
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
                <h6 class="text-muted font-weight-normal">Pending Purchase Request</h6>
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
                <h6 class="text-muted font-weight-normal">Rejected Purchase Request</h6>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card shadow p-5 mb-5 bg-white rounded">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title text-dark">All Purchase Request</h4>
                </div>
            </div>



            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-muted"> # </th>
                            <th class="text-muted"> Description </th>
                            <th class="text-muted"> Quantity </th>
                            <th class="text-muted"> Specification </th>
                            <th class="text-muted"> Directorate's / Project Name </th>
                            <th class="text-muted">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <form id="myForm" action="{{route('purchase.export')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @foreach($purchases as $purchase)
                            <tr>
                                <td class="py-1 text-muted">
                                    {{ $loop->iteration + $purchases->firstItem() - 1 }}
                                </td>
                                <td class="text-muted">{{$purchase->description}} </td>
                                <td>
                                    {{$purchase->quantity}}
                                </td>
                                <td class="text-muted">{{$purchase->specification}}</td>

                                <td class="text-muted">
                                    {{$purchase->project_name}}
                                </td>

                                <td>
                                    <a type="button" href="{{ route('detail.purchase',['id'=>$purchase->id ])}}" class="btn btn-primary">Detail</a>
                                    @if($purchase->user_id==auth()->user()->id)
                                    <a type="button" href="{{ route('edit.purchase',['id'=>$purchase->id ])}}" class="btn btn-success">Edit</a>
                                    @endif
                                    @hasrole('Super-Admin')
                                    <a type="button" href="{{ route('delete.purchase',['id'=>$purchase->id ])}}" class="btn btn-danger">Delete</a>
                                    @endhasrole
                                </td>

                            </tr>
                            @endforeach
                        </form>
                    </tbody>
                </table>
                {{$purchases->links()}}
            </div>
        </div>
    </div>
</div>
@endsection