<?php

namespace App\Services;

use App\Models\Student;
use App\Models\User;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(User $user, Supervisor $supervisor, Student $student)
    {
        $this->user = $user;
        $this->supervisor = $supervisor;
        $this->student = $student;
    }
    
    public function handleGetAllUser()
    {
        $data = $this->user->get();
        return $data;
    }

    public function handeGetUser()
    {
        $data = $this->user->find(2);
        return $data;
    }

    public function handleGetHierarchy($request)
    {
        $searchname = $request->input('name');
        $supervisors = $this->supervisor->where('status', 'active')->with("students.user")->get();
        $user = $this->user->where([['status', 'active'],['name', $searchname]])->first();

        if ($user == null) {

            foreach ($supervisors as $key => $value) {
                $datastudents = $supervisors->map(function ($sup) {
                    $data = $sup->students->where('status', 'active')->map(function ($student) {
                        $student = collect([
                            "name" => $student->user->name,
                        ]);
                        return $student;
                    });
                    return $data;
                });
                $data[] = collect([
                    "name" => $value->user->name,
                    "children" => $datastudents[$key],
                ]);
            }
    
            $return = [
                "name" => "Admin LnD",
                "url" => "http://127.0.0.1:8000/api/user/get-hierarchy",
                "children" => $data,
            ];

        } else {

            $students = $this->student->where([['supervisor_id', $user->supervisor->id], ['status', 'active']])->get();

            foreach ($students as $key => $value) {
                $data[] = collect([
                    'name' => $value->user->name,
                ]);
            }

            $return = [
                "name" => $user->name,
                "url" => "",
                "children" => $data ?? '',
            ];  
        }
        return $return;
    }
}