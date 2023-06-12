<?php

namespace App\Http\Controllers;

use App\Services\AttendanceService;
use App\Services\StudentService;
use App\Services\SupervisorService;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function __construct(SupervisorService $supervisorService, AttendanceService $attendanceService, StudentService $studentService)
    {
        $this->supervisorService = $supervisorService;
        $this->studentService = $studentService;
        $this->attendanceService = $attendanceService;
    }

    public function profile()
    {
        $supervisors = $this->supervisorService->handleGetProfile();
        $attendances = $this->attendanceService->handleGetDataAttendanceForSupervisor();
        $students = $this->supervisorService->handleGetSupervisorStudent();
        return view('supervisor.index', [
            'supervisors' => $supervisors,
            'attendances' => $attendances,
            'students' => $students,
        ]);
    }

    public function index(Request $request)
    {
        $supervisors = $this->supervisorService->handleGetAllSupervisor($request);
        return view('master.supervisor.index', [
            'supervisors' => $supervisors,
        ]);
    }

    public function detail(Request $request,$id)
    {
        $supervisor = $this->supervisorService->handleGetSupervisorById($id);
        $students = $this->studentService->handleGetAllStudent($request);
        return view('master.supervisor.detail', [
            'supervisor' => $supervisor,
            'students' => $students,
        ]);
    }

    public function create()
    {
        return view('master.supervisor.create');
    }

    public function store(Request $request)
    {
        $this->supervisorService->handlePostStoreSupervisor($request);
        return redirect('supervisor');
    }

    public function status($id)
    {
        $this->supervisorService->handlePutStatusSupervisor($id);
        return redirect('supervisor');
    }

    public function edit($id)
    {
        $data = $this->supervisorService->handleGetSupervisorById($id);
        return view('master.supervisor.edit', [
            'supervisor' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->supervisorService->handlePutUpdateSupervisor($request, $id);
        return redirect('supervisor');
    }

    public function getAllSupervisorApi(Request $request)
    {
        return response()->JSON(['status'=>200,'message' => 'success', 'data' => $this->supervisorService->handleGetAllSupervisor($request)], 200);
    }

    public function postStoreSupervisorApi(Request $request)
    {
        return response()->JSON(['status'=>200,'message' => 'success', 'data' => $this->supervisorService->handlePostStoreSupervisor($request)], 200);
    }

    public function putUpdateSupervisorApi(Request $request, $id)
    {
        return response()->JSON(['status'=>200,'message' => 'success', 'data' => $this->supervisorService->handlePutUpdateSupervisor($request, $id)], 200);
    }

    public function putStatusSupervisorApi(Request $request, $id)
    {
        return response()->JSON(['status'=>200,'message' => 'success', 'data' => $this->supervisorService->handlePutStatusSupervisor($request, $id)], 200);
    }
}
