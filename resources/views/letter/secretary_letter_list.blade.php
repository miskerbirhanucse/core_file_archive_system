@extends('layouts.main')

@section('content')

    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 10px;
            margin: 0 0 10px;
            min-width: 100%;
        }

        .table-title h2 {
            margin: 8px 0 0;
            font-size: 22px;
        }

        .search-box {
            position: relative;
            float: right;
        }

        .search-box input {
            height: 34px;
            border-radius: 20px;
            padding-left: 35px;
            border-color: #ddd;
            box-shadow: none;
        }

        .search-box input:focus {
            border-color: #3FBAE4;
        }

        .search-box i {
            color: #a0a5b1;
            position: absolute;
            font-size: 19px;
            top: 8px;
            left: 10px;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child {
            width: 130px;
        }

        table.table td a {
            color: #a0a5b1;
            display: inline-block;
            margin: 0 5px;
        }

        table.table td a.view {
            color: #03A9F4;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #E34724;
        }

        table.table td a.download {
            color: #009900;
        }

        table.table td i {
            font-size: 19px;
        }

        .pagination {
            float: right;
            margin: 0 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 95%;
            width: 30px;
            height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 30px !important;
            text-align: center;
            padding: 0;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;
            margin-top: 6px;
            font-size: 95%;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    </head>

    <body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Incoming Letter <b>Lists</b></h2>

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
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-dark" style="width: 10%">Project Name </i></th>
                        <th class="text-dark"> Subject </i></th>

                        @role('Head')
                        <th class="text-dark">
                            Action Taken
                        </th>
                        @endrole
                        @role('Team')
                        <th>
                            Action Taken
                        </th>
                        @endrole
                        <th class="text-dark">Created At</i></th>
                        <th class="text-dark">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($letters as $letter)
                        <tr>
                            <td>{{ $loop->iteration  }}</td>
                            <td>{{$letter->project->name}}</td>
                            <td>{{$letter->subject}}</td>
                            @role('Head')
                            <th class="text-dark">
                                @if($letter->dept_created_at != null)
                                    <input type="checkbox" class="border-info"   checked/>
                                @else
                                    <input type="checkbox"  />
                                @endif
                            </th>
                            @endrole
                            @role('Team')
                            <th class="text-dark">
                                @if($letter->team_description != null)
                                    <input type="checkbox" class="border-info"   checked/>
                                @else
                                    <input type="checkbox"  />
                                @endif</th>
                            @endrole
                            <td>{{$letter->created_at->diffForHumans()}}</td>
                            <td>
                                @hasanyrole('Secretary|Super-Admin')
                                <a href="{{route('letter.edit',['id'=>$letter->id])}}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                @endhasanyrole
                                <a href="{{route('letter.detail',['id'=>$letter->id])}}" class="edit" title="detail" data-toggle="tooltip"><i class="material-icons">&#xe5d4;</i></a>
                                <a href="{{route('letter.download',['id'=>$letter->id])}}" class="download" title="Download" data-toggle="tooltip"><i class="material-icons">&#xe2c4;</i></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="d-flex ">
                    @if(!is_array($letters))
                        {!!$letters->links()!!}
                    @endif
                </div>
                <!-- <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
    <!-- <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            fetch_letter_data();

            function fetch_letter_data(query = '') {
                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                });
                $.ajax({
                    method: 'GET',
                    url: "{{route('letter.search')}}",
                    data: {
                        'query': query,
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('tbody').html(data.table_data);
                        // $('#total_records').text(data.total_data)
                    },

                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

            }
            $(document).on('keyup', '#search', function() {
                var query = $(this).val();
                fetch_letter_data(query);
            });
        });
    </script> -->

@endsection
