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
                <p style="padding-top:20px; padding-left:20px"><b>Purchase Request Form</b></p>
            </div>

        </div>

        <div class="column">
            <div style="border-left: 2px solid black;height:60px">
                <p style="padding-top:20px; padding-left:20px"><b>CORE/HRMA/RF/012/C</b> </p>
            </div>

        </div>
    </div>

    <table style="width:100%;margin-top:50px;">
        <thead>
            <tr>
                <th>Item No</th>
                <th>Date</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Specification</th>
                <th>Directorate's/ Project Name</th>
                <th>Available in Store </th>

            </tr>

        </thead>
        <tbody>
            @foreach($purchases as $purchase)
            <tr>
                <td width="40px" style="font-size:12pt;padding-left:15px"> {{ $loop->iteration }}</td>
                <td width="80px">{{$purchase->created_at->format('Y-m-d')}}</td>
                <td>{{$purchase->description}}</td>
                <td width="60px" style="font-size:12pt;padding-left:15px">{{$purchase->quantity}}</td>
                <td>{{$purchase->specification}}</td>
                <td width="100px">{{$purchase->project_name}}</td>
                <td width="80px" style="font-size:15pt;padding-left:15px"><span> &#x000D7;</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row" style=" position: fixed;bottom: 40px;right: 0;width: 100%;">
        <div class="column">
            <p class="fw-bold">Requested by: <u>Mamo</u></p>
            <p class="fw-bold">Date: <u>21/09/2021</u></p>
        </div>
        <div class="column">

            <p>Approved by:<input type="checkbox" name="" checked id=""></p>

            <p class="fw-bold">Date: <u>21/09/2021</u></p>
        </div>
        <div class="column">
            <p class="fw-bold">Authorized by: <input type="checkbox" name="" checked id=""></p>
            <p class="fw-bold">Date: <u>21/09/2021</u></p>
        </div>

    </div>

</body>

</html>