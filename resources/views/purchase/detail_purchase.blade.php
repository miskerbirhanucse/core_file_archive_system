@extends('layouts.main')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body ">
            <h4 class="card-title text-dark font-weight-bold display-4">Detail Purchase Request</h4>

            <div class="form-group">
                <p for="exampleInputName1" class="text-dark display-5 ">Requested By: <b>{{$purchase->user->name}} </b></p>
            </div>
            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5 ">From Department:<b> {{$purchase->department->name}}</b> </p>

            </div>

            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">Description: <b>{{$purchase->description}}</b></p>
            </div>
            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">Specification: <b>{{$purchase->specification }}</b></p>
            </div>

            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">Quantity: <b>{{$purchase->quantity}}</b></p>
            </div>

            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">Project Name: <b>{{$purchase->project_name}}</b></p>
            </div>

            <div class="row">

                <div class="col-md-8">
                    <div class="form-group">
                        <p for="exampleInputEmail3" class="text-dark display-5">Approved By Department Head:
                            @if($purchase->approvedByDepartment != null)
                            <b>{{$purchase->approvedByDepartment->name}}</b>
                            @else
                            <b>Not Approved yet</b>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <p for="exampleInputEmail3" class="text-dark display-5">Is Approved:
                            @if($purchase->approved_by_department==0)
                            <b>Pending</b>
                            @elseif($purchase->approved_by_department==1)
                            <b>Approved</b>
                            @else
                            <b>Rejected</b>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <p for="exampleInputEmail3" class="text-dark display-5">Authorized By :
                            @if($purchase->authorizedBy != null)
                            <b>{{$purchase->authorizedBy->name}}</b>
                            @else
                            <b>Not Authorized yet</b>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <p for="exampleInputEmail3" class="text-dark display-5">Is Authorized:
                            @if($purchase->authorized==0)
                            <b>Pending</b>
                            @elseif($purchase->authorized==1)
                            <b>Authorized</b>
                            @else
                            <b>Rejected</b>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <p for="exampleInputEmail3" class="text-dark display-5">Approved By Property Administration Department:
                            @if($purchase->approvedByStore != null)
                            <b>{{$purchase->approvedByStore->name}}</b>
                            @else
                            <b>Not Approved yet</b>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <p for="exampleInputEmail3" class="text-dark display-5">Is Approved By Store:
                            @if($purchase->approved_by_store==0)
                            <b>Pending</b>
                            @elseif($purchase->approved_by_store==1)
                            <b>Approved</b>
                            @else
                            <b>Rejected</b>
                            @endif
                        </p>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <p for="exampleInputEmail3" class="text-dark display-5">Is Purchased:
                    @if($purchase->is_purchased==0)
                    <b>Not Purchased</b>
                    @else
                    <b>Yes, It is Purchased</b>
                    @endif
                </p>
            </div>
            <form action="{{ route('approve.purchase',['id'=>$purchase->id ])}}" method="POST" id="approve">
                @csrf
                {{method_field('PUT')}}
                @can('approve request')
                <div class="col-md-6">
                    <div class="container">
                        <h6 class="text-dark display-5">Approve Request</h6>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-success">
                            <label class="form-check-label">
                                <input type="checkbox" name="approve[]" class="form-check-input" value="1"> Approve
                            </label>
                        </div>
                        <div class="form-check form-check-danger">
                            <label class="form-check-label">
                                <input type="checkbox" name="approve[]" class="form-check-input" value="2"> Reject
                            </label>
                        </div>
                    </div>
                </div>
                @endcan
                @if($purchase->user_id == auth()->user()->id)
                <a type="submit" class="btn btn-primary mr-2 mb-5 " href="{{ route('edit.purchase',['id'=>$purchase->id ])}}">Edit</a>
                @endif
                @can('approve request')
                <button type="submit" form="approve" class="btn btn-primary mr-2 mb-5" href="">Approve</button>
                @endcan
            </form>
            <form action="{{ route('authorize.purchase',['id'=>$purchase->id ])}}" method="post" id="authorize">
                @csrf
                {{method_field('PUT')}}
                @can('authorize request')
                <div class="col-md-6">
                    <div class="container">
                        <h6 class="text-dark display-5 display-5">Authorize Request</h6>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-success">
                            <label class="form-check-label">
                                <input type="checkbox" name="authorize[]" class="form-check-input" value="1"> Authorize
                            </label>
                        </div>
                        <div class="form-check form-check-danger">
                            <label class="form-check-label">
                                <input type="checkbox" name="authorize[]" class="form-check-input" value="2"> Reject
                            </label>
                        </div>
                    </div>
                </div>

                @endcan
            </form>
            @can('authorize request')
            <button type="submit" form="authorize" class="btn btn-primary mr-2" onsubmit="authorize">Authorize</button>
            @endcan

            <form action="{{ route('store.approve.purchase',['id'=>$purchase->id ])}}" method="post" id="storeApprove">
                @csrf
                {{method_field('PUT')}}
                @can('export request')
                <div class="col-md-6">
                    <div class="container">
                        <h6 class="text-dark display-5 display-5">Store Approve Request</h6>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-success">
                            <label class="form-check-label">
                                <input type="checkbox" name="storeApprove[]" class="form-check-input" value="1"> Authorize
                            </label>
                        </div>
                        <div class="form-check form-check-danger">
                            <label class="form-check-label">
                                <input type="checkbox" name="storeApprove[]" class="form-check-input" value="2"> Reject
                            </label>
                        </div>
                    </div>
                </div>

                @endcan
            </form>
            @can('export request')
            <button type="submit" form="storeApprove" class="btn btn-primary mr-2" onsubmit="authorize">Store Approve</button>
            @endcan

        </div>
    </div>
</div>
@endsection