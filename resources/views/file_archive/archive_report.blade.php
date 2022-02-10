<!DOCTYPE html>
<html lang="en">

<head>
    <title>PDF</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="{{ public_path('css/app.css') }}" rel="stylesheet"> -->
    <style>
        * {
            box-sizing: border-box;
        }

        /* Create three equal columns that floats next to each other */
        .column {
            float: left;
            width: 33.33%;
            padding: 10px;

            /* Should be removed. Only for demonstration */
        }


        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
        }


        /* Clear floats after the columns */
        .row:after {

            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>

<body>


    <div class="row" style="border:3px solid black;">
        <div class="column">
            <img src="{{ public_path('images/logo.png')}}" style="height: 50px;padding-top:20px; padding-left:20px" alt="">
            <!-- <img src="{{ asset('images/logo.png')}}" style="height: 50px;" alt=""> -->
        </div>

        <div class="column">
            <div style="border-left: 2px solid black;height:60px">
                <p style="padding-top:20px; padding-left:20px"><b>Project Back Up Reporting Format</b></p>
            </div>

        </div>

        <div class="column">
            <div style="border-left: 2px solid black;height:60px">
                <p style="padding-top:20px; padding-left:20px"><b>CORE/GM/RF/005/A</b> </p>
            </div>

        </div>
    </div>
    <div style="text-align: center;">
        <p>For Month of: <u>{{$month}}</u></p>
    </div>
    <table style="width:100%;margin-top:50px;">
        <thead>
            <tr align="center">
                <th rowspan="2">S. No.</th>
                <th rowspan="2">Project</th>
                <th rowspan="2">Report Title</th>
                <th colspan="3">Version</th>
                <th rowspan="2">Department</th>
                <th rowspan="2">Backup Date</th>
                <th rowspan="2">Letter No.</th>

            </tr>
            <tr>
                <th>Draft</th>
                <th>Final</th>
                <th>Other</th>
            </tr>

        </thead>
        <tbody>
            @foreach($archives as $archive)
            <tr>
                <td width="20px" style="font-size:12pt;padding-left:15px"> {{ $loop->iteration }}</td>
                <td width="150px">{{$archive->project_name}}</td>
                <td width="120px">{{$archive->subject}}</td>
                <td width="20px" style="font-size:12pt;padding-left:15px">
                    @if($archive->file_version==='draft')
                    <input type="checkbox" checked />
                    @else
                    <p></p>
                    @endif
                </td>
                <td width="20px" style="font-size:12pt;padding-left:15px">
                    @if($archive->file_version==='final')
                    <input type="checkbox" checked />
                    @else
                    <p></p>
                    @endif
                </td>
                <td width="20px" style="font-size:12pt;padding-left:15px">
                    @if($archive->file_version==="other")
                    <input type="checkbox" checked />
                    @else
                    <p></p>
                    @endif
                </td>
                <td width="80px">{{$archive->department->name}}</td>
                <td width="40px">{{$archive->created_at->isoFormat('DD-MMM-YY')}}</td>
                <td width="50px" style="font-size:15pt;padding-left:15px">{{$archive->ref_no}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style=" text-align:center; ">
        <p class="fw-bold">Prepared By: <u>Dereje Zewde </u> {{$currentTime}}</p>

    </div>

</body>

</html>