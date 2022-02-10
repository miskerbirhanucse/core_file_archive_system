@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card shadow p-5 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-dark">{{$totalPurchases}}</h3>
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
                            <h3 class="mb-0 text-dark ">{{$purchases->count()}}</h3>

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
                            <h3 class="mb-0 text-dark">0</h3>
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
                            <h3 class="mb-0 text-dark">0</h3>

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
                @can('export request')
                <div class="col-md-6 float-right">
                    <button class="btn btn-primary" form="myForm" type="submit" style="float:right">Export PDF</button>
                </div>
                @endcan
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
                            <!-- <th class="text-muted">Action</th> -->
                            @can('export request')
                            <th class="text-muted">Export</th>
                            @endcan
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
                                @can('export request')
                                <td>
                                    <input type="checkbox" name="exports[]" value="{{ $purchase->id }}">
                                </td>
                                @endcan
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