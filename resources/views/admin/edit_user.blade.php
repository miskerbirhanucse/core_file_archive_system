@extends('layouts.main')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body ">
            <h4 class="card-title text-dark">Assign role and Permission , Approve or Reject user</h4>
            <form class="forms-sample" method="POST" action="{{ route('admin.update_user',['id'=>$user->id])}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1" class="text-dark"><b>Name: {{$user->name}}</b></label>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Email address: {{$user->email}}</label>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Password: {{Crypt::decryptString($user->password)}}</label>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Department: {{$user->department()->first()->name}}</label>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="container">
                            <h6 class="text-dark">Request Permissions</h6>
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-primary">
                                <label class="form-check-label">
                                    <input type="checkbox" name="permissions[]" class="form-check-input" value="create request">create request</label>
                            </div>
                            <div class="form-check form-check-success">
                                <label class="form-check-label">
                                    <input type="checkbox" name="permissions[]" class="form-check-input" value="approve request">approve request</label>
                            </div>
                            <div class="form-check form-check-info">
                                <label class="form-check-label">
                                    <input type="checkbox" name="permissions[]" class="form-check-input" value="access request"> access request </label>
                            </div>
                            <div class="form-check form-check-danger">
                                <label class="form-check-label">
                                    <input type="checkbox" name="permissions[]" class="form-check-input" value="delete request"> delete request </label>
                            </div>
                            <div class="form-check form-check-warning">
                                <label class="form-check-label">
                                    <input type="checkbox" name="permissions[]" class="form-check-input" value="edit request"> edit request </label>
                            </div>
                            <div class="form-check form-check-warning">
                                <label class="form-check-label">
                                    <input type="checkbox" name="permissions[]" class="form-check-input" value="view request"> view request </label>
                            </div>
                            <div class="form-check form-check-warning">
                                <label class="form-check-label">
                                    <input type="checkbox" name="permissions[]" class="form-check-input" value="authorize request"> authorize request </label>
                            </div>
                            <div class="form-check form-check-warning">
                                <label class="form-check-label">
                                    <input type="checkbox" name="permissions[]" class="form-check-input" value="export request"> export request </label>
                            </div>
                            <div class="form-check form-check-warning">
                                <label class="form-check-label">
                                    <input type="checkbox" name="permissions[]" class="form-check-input" value="store approve request"> store approve request </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="container">
                            <h6 class="text-dark">Role</h6>
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-primary">
                                <label class="form-check-label">
                                    <input type="checkbox" name="roles[]" value="Head" class="form-check-input">Head </label>
                            </div>
                            <div class="form-check form-check-success">
                                <label class="form-check-label">
                                    <input type="checkbox" name="roles[]" value="Team Leader" class="form-check-input">Team Leader </label>
                            </div>
                            <div class="form-check form-check-success">
                                <label class="form-check-label">
                                    <input type="checkbox" name="roles[]" value="Team" class="form-check-input">Team </label>
                            </div>
                            <div class="form-check form-check-success">
                                <label class="form-check-label">
                                    <input type="checkbox" name="roles[]" value="Secretary" class="form-check-input">Secretary</label>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="container">
                            <h6 class="text-dark">Approval</h6>
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-success">
                                <label class="form-check-label">
                                    <input type="checkbox" name="approved" class="form-check-input"> Approve </label>
                            </div>
                            <div class="form-check form-check-danger">
                                <label class="form-check-label">
                                    <input type="checkbox" name="rejected" class="form-check-input"> Reject </label>
                            </div>

                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Update</button>

            </form>
        </div>
    </div>
</div>
@endsection