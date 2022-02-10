@extends('layouts.main')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body ">
            <h4 class="card-title text-dark display-4">Purchase Request Form</h4>
            <form class="forms-sample" method="POST" action="{{ route('purchase.update',['id'=>$purchase->id])}}">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1" class="text-dark font-weight-bold">Description</label>
                    <textarea class="form-control bg-white text-dark" name="description" id="exampleTextarea1" rows="4" required>{{$purchase->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Quantity</label>
                    <input value="{{$purchase->quantity}}" type="number" class="form-control bg-white text-dark" name="quantity" id="exampleInputName1" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Specification</label>
                    <textarea class="form-control bg-white text-dark" name="specification" id="exampleTextarea1" rows="4" required>{{$purchase->specification}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Directorate's/ Project Name</label>
                    <input type="text" value="{{$purchase->project_name}}" class="form-control bg-white text-dark" name="project name" id="exampleInputName1" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3" class="text-dark font-weight-bold">Department</label>
                    <select name="department_id" class="form-control bg-white text-dark" required>
                        <option class="form-control bg-white text-dark" value="">Select</option>
                        @foreach($departments as $department)
                        <option value="{{$department->id}}" {{$purchase->department_id==$department->id?'selected':''}}>{{$department->name}}</option>
                        @endforeach
                    </select>
                    <!-- <label for="exampleInputEmail3" class="text-dark font-weight-bold">Directorate's/ Project Name</label>
                    <input type="text" class="" name="project name" id="exampleInputName1" placeholder=""> -->
                </div>

                <button type="Update" class="btn btn-primary mr-2">Create</button>

            </form>
        </div>
    </div>
</div>
@endsection