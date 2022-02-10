@extends('layouts.main')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body ">
            <h4 class="card-title text-dark display-4">Generate Archive Report</h4>
            <form action="{{route('archive.report')}}" method="GET">
                @csrf
                <div class="input-group mb-3 col-4 ">
                    <label for="starting" class="text-dark mr-3">From</label>
                    <input type="date" class="form-control bg-white text-dark" name="start_date" required>


                </div>
                <div class="input-group mb-3 col-4 ">
                    <label for="starting" class="text-dark mr-3">To</label>
                    <input type="date" class="form-control bg-white text-dark" name="end_date" required>
                </div>
                <div class="input-group mb-3 col-4 ">
                    <label for="starting" class="text-dark mr-3">Enter month and year</label>
                    <input type="text" class="form-control bg-white text-dark" name="month" required>
                </div>
                <button type="submit" class="btn btn-primary mr-2 mt-5">Generate</button>
            </form>



            </form>
        </div>
    </div>
</div>
@endsection