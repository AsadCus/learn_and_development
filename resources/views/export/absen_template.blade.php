<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{$user->id}}_{{$user->name}}_{{$user->email}}_{{$period_start}}</title>
    <style>
        td {
            font-size: 8px;
        }

        th {
            font-size: 8px;
        }
    </style>
</head>

<body>

<h1 style="text-align: center;font-size:9px">ATTENDANCE REPORT</h1>
<table>
    <tr>

        <td>
            <table>
                <tr>
                    <td>id: {{$user->id}}</td>
                </tr>
                <tr>
                    <td>Nama: {{$user->name}}</td>
                </tr>
                <tr>
                    <td>Email: {{$user->email}}</td>
                </tr>
            </table>
        </td>
        <td>
            <table>
                <tr>
                    <td>Employee Title: -</td>
                </tr>
                <tr>
                    <td>Employee Hire Date: -</td>
                </tr>
                <tr>
                    <td>Organization: : -</td>
                </tr>
            </table>
        </td>
    </tr>
    {{-- <td></td> --}}

</table>
<br/>
<table style="border-spacing: 0; border:1px solid black;" width="100%">
    <tr style="border:1px solid black">
        <th style="border-bottom: 1px solid black" width="50px">Day</th>
        <th style="border-bottom: 1px solid black">Tanggal</th>
        <th style="border-bottom: 1px solid black">Working Hour</th>
        <th style="border-bottom: 1px solid black">Activity</th>
        <th style="border-bottom: 1px solid black">Duty On</th>
        <th style="border-bottom: 1px solid black">Duty Off</th>
        <th style="border-bottom: 1px solid black">Working Hour</th>
        <th style="border-bottom: 1px solid black">Note</th>
    </tr>

    @foreach ($data as $item)
        <tr style="border: 1px solid black">
            <td style="border-bottom:1px solid #f0f0f0">{{Carbon\Carbon::parse(explode(' ',
                $item->clock_in)[0])->format('D')}}
            </td>
            <td style="border-bottom:1px solid #f0f0f0">
                {{Carbon\Carbon::parse(explode(' ',
                $item->clock_in)[0])->format('d/m/Y')}}
            </td>
            <td style="border-bottom:1px solid #f0f0f0"><span>09:00 - 18:00</span></td>
            <td style="border-bottom:1px solid #f0f0f0">{{Carbon\Carbon::parse(explode(' ',
                $item->clock_in)[0]) > Carbon\Carbon::now() ? "-": ($item->work_type == null ? "Absent" :
                $item->work_type)}}</td>
            <td style="border-bottom:1px solid #f0f0f0">{{Carbon\Carbon::parse(explode(' ',
                $item->clock_in)[0]) > Carbon\Carbon::now() ? "-":explode(' ', $item->clock_in)[1]}}</td>
            <td style="border-bottom:1px solid #f0f0f0">{{Carbon\Carbon::parse(explode(' ',
                $item->clock_out)[0]) > Carbon\Carbon::now() ? "-":explode(' ', $item->clock_out)[1]}}</td>
            <td style="border-bottom:1px solid #f0f0f0">{{$item->working_hour }}</td>
            <td style="border-bottom:1px solid #f0f0f0">{{$item->note }}</td>
        </tr>
    @endforeach

</table>
<br/>
<table>
    <tr>
        <td>
            <table>
                <tr>
                    <td>Working Day</td>
                </tr>
                <tr>
                    <td>Non Working Day</td>
                </tr>
                <tr>
                    <td>Holiday</td>
                </tr>
                <tr>
                    <td>Attendance</td>
                </tr>
                <tr>
                    <td><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        Work Day
                    </td>
                </tr>
                <tr>

                    <td><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        Not Work Day
                    </td>
                </tr>
                <tr>
                    <td>Absence Status + Absent</td>
                </tr>
                <tr>
                    <td>Absent</td>
                </tr>
                <tr>
                    <td>Late</td>
                </tr>
                <tr>
                    <td>Early Departure</td>
                </tr>
                <tr>
                    <td>Over Time</td>
                </tr>
            </table>
        </td>
        <td>
            <table>
                <tr>
                    <td>
                        <span>:&nbsp;{{$dashboard["working_day"]}}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>:&nbsp;{{$dashboard["non_working_day"]}}</span>
                    </td>

                </tr>
                <tr>
                    <td>
                        <span>:&nbsp;-</span>
                    </td>

                </tr>
                <tr>
                    <td>
                        <span>:&nbsp;{{$dashboard["total_wfo"]}}</span>
                    </td>

                </tr>
                <tr>
                    <td>
                        <span>:&nbsp;{{$dashboard["total_wfh"]}}</span>
                    </td>

                </tr>
                <tr>
                    <td>
                        <span>:&nbsp;{{$dashboard["working_day"]}}</span>
                    </td>

                </tr>
                <tr>
                    <td>
                        <span>:&nbsp;{{$dashboard["alpa"] + $dashboard["penugasan"]}}</span>
                    </td>

                </tr>
                <tr>
                    <td>
                        <span>:&nbsp;{{$dashboard["alpa"]}}</span>
                    </td>

                </tr>
                <tr>
                    <td>
                        <span>:&nbsp;{{$dashboard["late_in"]}}</span>
                    </td>

                </tr>
                <tr>
                    <td>
                        <span>:&nbsp;-</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>:&nbsp;-</span>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>


</body>

</html>