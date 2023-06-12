<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\StudentService;
use App\Services\AttendanceService;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class AttendanceController extends Controller
{
    public function __construct(AttendanceService $attendanceService, StudentService $studentService, UserService $userService, User $user, Attendance $attendance)
    {
        $this->attendanceService = $attendanceService;
        $this->studentService = $studentService;
        $this->userService = $userService;
        $this->user = $user;
        $this->attendance = $attendance;
    }

    public function index(Request $request)
    {
        // try {
            $attendances = $this->attendanceService->handleGetAllAttendance($request);
            return view('master.attendance.index', [
                'attendances' => $attendances,
            ]);
        // } catch (\Exception $e) {
        //     return Redirect::back()->withError($e->getMessage());
        // }
    }
    

    public function store(Request $request)
    {
        try {
            $this->attendanceService->handlePostStoreAttendance($request);
            return redirect()->back();
        } catch (\Exception $e) {
            return Redirect::back()->withError($e->getMessage());
        }
    }

    public function approveattendance($id)
    {
        try {
            $this->attendanceService->handleApproveAttendance($id);
            return redirect()->back();
        } catch (\Exception $e) {
            return Redirect::back()->withError($e->getMessage());
        }
    }

    public function rejectattendance($id)
    {
        try {
            $this->attendanceService->handleRejectAttendance($id);
            return redirect()->back();
        } catch (\Exception $e) {
            return Redirect::back()->withError($e->getMessage());
        }
    }

    public function exportAbsen(Request $request)
    {
        // $daterange = $request->input('daterange');
        // dd($daterange);
        // $date  = explode(' - ',$request->daterange);
        // $start = str_replace('/', '-', $date[0]);
        // $end = str_replace('/', '-', $date[1]);
        // $user_id = $request->user_id;
        // $this->attendanceService->handleExportAbsen($start, $end, $user_id);

        $date  = explode(' - ',$request->daterange);
        // dd($date);
        // $start = str_replace('/', '-', $date[0]);
        // $end = str_replace('/', '-', $date[1]);
        $start = date('d-m-Y H:i:s', strtotime($date[0]));
        $end = date('d-m-Y H:i:s', strtotime($date[1]));
        // dd($start);
        $user_id = $request->user_id;

        $period = CarbonPeriod::create($start, $end);
        $period_start = Carbon::now()->format('M_Y');
        $absen_result = $period->toArray();
        // dd($absen_result);
        $user = $this->user->find($user_id);
        $working_day  = 0;
        $non_working_day = 0;
        $total_wfo = 0;
        $total_wfh = 0;
        $late_in = 0;
        $early_out = 0;
        $alpa = 0;
        $uneligible_working_hour = 0;
        $penugasan = 0;

        for ($i = 0; $i < count($absen_result); $i++) {
            $absen_increment = $this->attendance->where('user_id', $user_id)->where('clock_in', 'LIKE', '%' . $absen_result[$i]->format("d-m-Y") . '%')->first();
            if (false) {
                $absen = new Attendance;
                $absen->clock_in = $absen_result[$i]->format("d-m-Y") . " 00:00:00";
                $absen->clock_out = $absen_result[$i]->format("d-m-Y") . " 00:00:00";
                $absen->work_type = "Off";
                $absen->user_id = $user_id;
                $absen_result[$i] =  $absen;
            } else {
                if ($absen_increment != null) {
                    $working_day++;
                    if ($absen_increment->work_type == "WFO") {
                        $total_wfo++;
                    } else {
                        $total_wfh++;
                    }
                    if (explode(" ", $absen_increment->clock_in)[1] > "09:15:00") {
                        $late_in++;
                    };

                    if (explode(" ", $absen_increment->clock_out)[1] < "18:00:00" && explode(" ", $absen_increment->clock_out)[1] != "00:00:00") {
                        $early_out++;
                    };
                    if ($absen_increment->working_hour != null) {
                        if ($absen_increment->working_hour > "09:00:00") {
                            $uneligible_working_hour++;
                        }
                    }
                    if ($absen_increment->notes != null) {
                        $penugasan++;
                    }
                    $absen_result[$i] =  $absen_increment;
                } else {
                    $non_working_day++;
                    $alpa++;
                    $absen = new Attendance;
                    $absen->clock_in = $absen_result[$i]->format("d-m-Y") . " 00:00:00";
                    $absen->clock_out = $absen_result[$i]->format("d-m-Y") . " 00:00:00";
                    $absen->user_id = $user_id;
                    $absen_result[$i] =  $absen;
                }
            }
        }

        $dashboard =  collect([
            "working_day" => $working_day,
            "non_working_day" => $non_working_day,
            "total_wfo" => $total_wfo,
            "total_wfh" => $total_wfh,
            "late_in" => $late_in,
            "early_out" => $early_out,
            "sick" => 0,
            "izin" => 0,
            "leave" => 0,
            "alpa" => $alpa,
            "penugasan" => $penugasan,
        ]);
        
        $pdf = PDF::loadview('export.absen_template', ['data' => $absen_result, 'user' => $user, "dashboard" => $dashboard, 'period_start' => $period_start]);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream($user->id . "" . $user->name . "" . $user->email . "_" . $period_start);
    }

    public function getAllAttendanceApi(Request $request)
    {
        return response()->JSON(['status'=>200,'message' => 'success', 'data' => $this->attendanceService->handleGetAllAttendance($request)], 200);
    }

    public function postStoreAttendanceApi(Request $request)
    {
        return response()->JSON(['status'=>200,'message' => 'success', 'data' => $this->attendanceService->handlePostStoreAttendance($request)], 200);
    }
    
    public function putUpdateAttendanceApi(Request $request, $id)
    {
        return response()->JSON(['status'=>200,'message' => 'success', 'data' => $this->attendanceService->handlePutUpdateAttendance($request, $id)], 200);
    }

    public function putStatusAttendanceApi(Request $request, $id)
    {
        return response()->JSON(['status'=>200,'message' => 'success', 'data' => $this->attendanceService->handlePutStatusAttendance($request, $id)], 200);
    }
}
