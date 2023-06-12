<?php

namespace App\Services;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class AttendanceService
{
    public function __construct(Attendance $attendance, User $user, Student $student)
    {
        $this->attendance = $attendance;
        $this->user = $user;
        $this->student = $student;
    }
    
    public function handleGetAllAttendance($request)
    {
        $param_show_pending = $request->input('show_pending');
        $param_show_reject = $request->input('show_reject');
        $param_show_present = $request->input('show_present');
        
        if ($param_show_pending == 'true') {
            $show_pending = 'pending';
        } else {
            $show_pending = null;
        }
        if ($param_show_reject == 'true') {
            $show_reject = 'reject';
        } else {
            $show_reject = null;
        }
        if ($param_show_present == 'true') {
            $show_present = 'present';
        } else {
            $show_present = null;
        }

        if ($show_pending == null && $show_reject == null && $show_present == null) {
            $show_pending = 'pending';
            $show_reject = 'reject';
            $show_present = 'present';
        }
        
        $attendance_type = [$show_pending, $show_reject, $show_present];

        $fromDate = $request->input('clock_in');
        $toDate = $request->input('clock_out');

        if ($fromDate) {
            $data = $this->attendance->orderBy('clock_in', 'desc')->whereBetween('clock_in', [$fromDate, $toDate])->get();
        } else {
            $data = $this->attendance->orderBy('clock_in', 'desc')
            ->when($attendance_type, function ($query, $attendance_type){return $query->whereIn('attendance_type', $attendance_type);})
            ->get();
        }
        return $data;
    }

    public function handleGetDataAttendanceForSupervisor()
    {
        $data = $this->attendance->where('attendance_type', 'pending')
        ->whereHas('user.student', function($q) {
            $q->where('supervisor_id', Auth::user()->supervisor_id);
        })->get();       
        return $data;
    }

    public function handleGetAttendanceByUser()
    {
        $attendance = $this->attendance->where('user_id', Auth::user()->id)->orderBy('clock_in', 'desc')->get();
        if ($attendance == null) {
            return(null);
        }
        $data = $attendance->whereBetween('clock_in', [Carbon::today()->format('Y-m-d')." 00:00:00",Carbon::today()->format('Y-m-d')." 23:59:59"])->first();
        return $data;
    }

    public function handleGetLogAttendance($id, $request)
    {
        $fromDate = $request->input('clock_in');
        $toDate = $request->input('clock_out');
        $user_id = $this->student->find($id)->user->id;
        
        if ($fromDate) {
            $data = $this->attendance->orderBy('clock_in', 'desc')->where('user_id', $user_id)->whereBetween('clock_in', [$fromDate, $toDate])->get();
        } else {
            $data = $this->attendance->orderBy('clock_in', 'desc')->where('user_id', $user_id)->get();
        }
        
        return $data;
    }

    public function handleGetLogAttendanceStudent($request)
    {
        $fromDate = $request->input('clock_in');
        $toDate = $request->input('clock_out');

        if ($fromDate) {
            $data = $this->attendance->orderBy('clock_in', 'desc')->where('user_id', Auth::user()->id)->whereBetween('clock_in', [$fromDate, $toDate])->get();
        } else {
            $data = $this->attendance->orderBy('clock_in', 'desc')->where('user_id', Auth::user()->id)->get();
        }
        
        return $data;
    }

    public function handlePostStoreAttendance($request)
    {
        // dd($request);
        $reqData = $request->validate([
            'user_id' => 'required',
            'clock_in' => 'nullable',
            'clock_out' => 'nullable',
            'activity' => 'nullable',
            'attachment' => 'nullable',
            'working_hour' => 'nullable',
            'notes' => 'nullable',
            'work_type' => 'required',
            'attendance_type' => 'required',
            'status' => '',
        ]);

        $reqData['clock_in'] = Carbon::now()->format('d-m-Y H:i:s');
        $reqData['status'] = 'active';

        $data = $this->attendance->create($reqData);
        return ($data);
    }

    public function handleGetEditAttendance($id)
    {   
        $data = $this->attendance->find($id);
        return $data;
    }

    public function handlePutUpdateAttendance($request, $id)
    {
        $data = $this->attendance->find($id);
        
        // $data_clock_in = strtotime($data->clock_in);
        // if ($request->attendance_type == 'off') {
        //     $data_clock_out = strtotime(Carbon::now()->format('d-m-Y H:i:s'));
        // } else {
        //     $data_clock_out = null;
        // }
        // $clock_out = date('d-m-Y H:i:s', $data_clock_out);
        // $working_hour = gmdate('H:i', $data_clock_out - $data_clock_in);

        $data->update([
            'user_id' => $request->user_id,        
            'activity' => $request->activity,
            'attachment' => $request->attachment,
            'notes' => $request->notes,
            'work_type' => $request->work_type,
            'attendance_type' => $request->attendance_type,
            'created_at' => $request->created_at,
        ]);

        return $data;
    }

    public function handlePutClockoutAttendance($request, $id)
    {
        $data = $this->attendance->find($id);
        //upload attachment
        if ($request->hasFile('attachment')) {            
            $file = str_replace(' ','-',$request->file('attachment')->getClientOriginalName());
            $filename = Carbon::now()->format('Hisdmy').'_'.$file;
            $request->file('attachment')->move(public_path('attachment'), $filename);
            $data->update([
                'attachment' => $filename,
            ]);
        }
        //clockout time
        $data_clock_in = strtotime($data->clock_in);
        $data_clock_out = strtotime(Carbon::now()->format('d-m-Y H:i:s'));
        $clock_out = date('d-m-Y H:i:s', $data_clock_out);
        $working_hour = gmdate('H:i:s', $data_clock_out - $data_clock_in);

        $data->update([      
            'clock_out' => $clock_out,
            'activity' => $request->activity,
            'working_hour' => $working_hour,
            'notes' => $request->notes,
        ]);
    }

    public function handlePutStatusAttendance($id)
    {
        $data = $this->attendance->find($id);

        if ($data->status == 'active') {
            $status = 'deactive';
        } else {
            $status = 'active';
        }

        $updateData = $data->update([
            'status' => $status,
        ]);

        return $updateData;
    }

    public function handleApproveAttendance($id)
    {
        $data = $this->attendance->find($id);
        $updateData = $data->update([
        'attendance_type' => 'present',
        ]);

        return $updateData;
    }

    public function handleRejectAttendance($id)
    {
        $data = $this->attendance->find($id);
        $updateData = $data->update([
        'attendance_type' => 'reject',
        ]);

        return $updateData;
    }

}