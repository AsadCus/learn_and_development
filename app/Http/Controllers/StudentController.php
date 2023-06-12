<?php

namespace App\Http\Controllers;

use App\Services\AttendanceService;
use App\Services\ScoreService;
use App\Services\StudentService;
use App\Services\SupervisorService;
use App\Services\InstituteService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StudentController extends Controller
{
    public function __construct(StudentService $studentService, SupervisorService $supervisorService, AttendanceService $attendanceService, ScoreService $scoreService, InstituteService $instituteService)
    {
        $this->studentService = $studentService;
        $this->supervisorService = $supervisorService;
        $this->attendanceService = $attendanceService;
        $this->scoreService = $scoreService;
        $this->instituteService = $instituteService;
    }

    public function profile(Request $request)
    {
            $attendance = $this->attendanceService->handleGetAttendanceByUser();
            $indexattendance = $this->attendanceService->handleGetLogAttendanceStudent($request);
            $profiles = $this->studentService->handleGetProfile();
            $PIC = $this->studentService->handlePIC();
            $document = $this->studentService->handleGetAllDocument();
            return view('student.profile', [
                'today' => Carbon::now('l'),
                'profiles' => $profiles,
                'PIC' => $PIC,
                'attendance' => $attendance,
                'indexattendance' => $indexattendance,
                'document' => $document
            ]);

    }

    public function profileEdit(Request $request, $id)
    {
        $student = $this->studentService->handleGetEditStudentById($id);
        $institute = $this->instituteService->handleGetAllInstitute($request);
        return view('student.edit', [
            'student' => $student,
            'institute' => $institute,
        ]);
    }

    public function profileUpdate(Request $request, $id)
    {
        try {
            // dd($request);
            $this->studentService->handlePutUpdateStudentByStudent($request, $id);
            return redirect()->route('profile.student');
        } catch (\Exception $e) {
            return Redirect::back()->withError($e->getMessage());
        }
    }

    public function updateCV(Request $request, $id)
    {
        // dd($request);
        $this->studentService->handlePostCV($request, $id);
        return redirect()->route('profile.student');
    }

    public function deleteCV( $id)
    {
        $this->studentService->handleDeleteCV($id);
        return redirect()->route('profile.student');
    }

    public function detail($id, Request $request)
    {
        $attendance = $this->attendanceService->handleGetLogAttendance($id, $request);
        $student = $this->studentService->handleGetByStudent($id);
        $document = $this->studentService->handleGetAllDocument();
        $scores = $this->scoreService->handleGetStudentDetailScore($id);
        return view('supervisor.profile', [
            'student' => $student,
            'scores' => $scores,
            'document' => $document,
            'attendance' => $attendance,
        ]);
    }

    public function index(Request $request)
    {
        try {
            $students = $this->studentService->handleGetAllStudent($request);
            return view('master.student.index', [
                'students' => $students,
            ]);
        } catch (\Exception $e) {
            return Redirect::back()->withError($e->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $supervisors = $this->supervisorService->handleGetAllSupervisor($request);
            return view('master.student.create', [
                'supervisors' => $supervisors,
            ]);
        } catch (\Exception $e) {
            return Redirect::back()->withError($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $this->studentService->handlePostStoreStudent($request);
            return redirect('/student');
        } catch (\Exception $e) {
            return Redirect::back()->withError($e->getMessage());
        }
    }

    public function status($id)
    {
        try {
            $this->studentService->handlePutStatusStudent($id);
            return redirect('student');
        } catch (\Exception $e) {
            return Redirect::back()->withError($e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $supervisors = $this->supervisorService->handleGetAllSupervisor($request);
            $data = $this->studentService->handleGetByStudent($id);
            $institute = $this->instituteService->handleGetAllInstitute($request);
            return view('master.student.edit', [
                'student' => $data,
                'supervisors' => $supervisors,
                'institute' => $institute
            ]);
        } catch (\Exception $e) {
            return Redirect::back()->withError($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->studentService->handlePutUpdateStudent($request, $id);
            return redirect('student');
        } catch (\Exception $e) {
            return Redirect::back()->withError($e->getMessage());
        }
    }

    public function clockin(Request $request)
    {
        try {
            $this->attendanceService->handlePostStoreAttendance($request);
            return redirect()->back();
        } catch (\Exception $e) {
            return Redirect::back()->withError($e->getMessage());
        }
    }

    public function clockout(Request $request, $id)
    {
        try {
            $this->attendanceService->handlePutClockoutAttendance($request, $id);
            return redirect()->back();
        } catch (\Exception $e) {
            return Redirect::back()->withError($e->getMessage());
        }
    }

    public function storeDoc(Request $request)
    {
        try {
            $this->studentService->handleUploadFile($request);
            return redirect()->back();
        } catch (\Exception $e) {
            return Redirect::back()->withError($e->getMessage());
        }
    }

    public function destroyDoc($id)
    {
        try {
            $this->studentService->handleDeleteFile($id);
            return redirect()->back();
        } catch (\Exception $e) {
            return Redirect::back()->withError($e->getMessage());
        }
    }

    public function getAllStudentApi(Request $request)
    {
        return response()->JSON(['status'=>200,'message' => 'success', 'data' => $this->studentService->handleGetAllStudent($request)], 200);
    }

    public function postStoreStudentApi(Request $request)
    {
        return response()->JSON(['status'=>200,'message' => 'success', 'data' => $this->studentService->handlePostStoreStudent($request)], 200);
    }

    public function putUpdateStudentApi(Request $request, $id)
    {
        return response()->JSON(['status'=>200,'message' => 'success', 'data' => $this->studentService->handlePutUpdateStudent($request, $id)], 200);
    }

    public function putStatusStudentApi(Request $request, $id)
    {
        return response()->JSON(['status'=>200,'message' => 'success', 'data' => $this->studentService->handlePutStatusStudent($id)], 200);
    }
}
