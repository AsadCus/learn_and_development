<?php

namespace App\Http\Controllers;

use App\Services\InstituteService;
use App\Services\StudentService;
use Illuminate\Http\Request;

class InstituteController extends Controller
{
    public function __construct(instituteService $instituteService, StudentService $studentService)
    {
        $this->instituteService = $instituteService;
        $this->studentService = $studentService;
    }

    public function index(Request $request)
    {
        $institute = $this->instituteService->handleGetAllinstitute($request);
        return view('master.institute.index', [
            'institute' => $institute,
        ]);
    }

    public function detail(Request $request, $id)
    {
        $student = $this->studentService->handleGetAllStudent($request);
        $institute = $this->instituteService->handleGetInstituteById($id);
        return view('master.institute.detail', [
            'institute' => $institute,
            'students' => $student
        ]);
    }

    public function create()
    {
        return view('master.institute.create');
    }

    public function store(Request $request)
    {
        // try {
            // dd($request);
            $this->instituteService->handlePostStoreInstitute($request);
            return redirect()->route('institute.get.index');
        // } catch (\Exception $e) {
        //     return Redirect::back()->withError($e->getMessage());
        // }
    }

    public function edit($id)
    {
        $institute = $this->instituteService->handleGetInstituteById($id);
        return view('master.institute.edit', [
            'institute' => $institute
        ]);
    }

    public function update(Request $request, $id)
    {
        // try {
            // dd($request);
            $this->instituteService->handlePutUpdateInstitute($request, $id);
            return redirect()->route('institute.get.index');
        // } catch (\Exception $e) {
        //     return Redirect::back()->withError($e->getMessage());
        // }
    }

}
