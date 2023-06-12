<?php

namespace App\Http\Controllers;

use App\Services\ScoreService;
use App\Services\StudentService;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function __construct(ScoreService $scoreService, StudentService  $studentService)
    {
        $this->scoreService = $scoreService;
        $this->studentService = $studentService;
    }

    public function index()
    {
        $scores = $this->scoreService->handleGetAllScore();
        $formscores = $this->scoreService->handleGetAllForm();
        return view('master.score.index', [
            'scores' => $scores,
            'formscores' => $formscores,
        ]);
    }
    
    public function create($id)
    {
        $student = $this->studentService->handleGetByStudent($id);
        $scoreforms = $this->scoreService->handleGetAllForm();
        $scorevalues = $this->scoreService->handleGetAllFormValue();
        return view('master.score.create', [
            'student' => $student,
            'scoreforms' => $scoreforms,
            'scorevalues' => $scorevalues,
        ]);
    }

    public function store(Request $request)
    {
        $this->scoreService->handlePostStoreScore($request);
        return redirect()->route('student.get.detail', ['id' => $request->student_id]);
    }


    public function getAllScoreApi()
    {
        return response()->JSON(['status'=>200,'message' => 'success', 'data' => $this->scoreService->handleGetAllScore()], 200);
    }
}
