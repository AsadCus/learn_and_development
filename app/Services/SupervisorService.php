<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorService
{
    public function __construct(Supervisor $supervisor, User $user, Student $student)
    {
        $this->supervisor = $supervisor;
        $this->user = $user;
        $this->student = $student;
    }

    public function handleGetProfile()
    {
        $data = $this->user->with('supervisor')->where('id', Auth::user()->id)->get();
        return $data;
    }
    
    public function handleGetAllSupervisor($request)
    {
        $fromDate = $request->input('start_date');
        $toDate = $request->input('end_date');
        if ($fromDate) {
            $data = $this->supervisor->whereBetween('created_at', [$fromDate, $toDate])->get();
        } else {
            $data = $this->supervisor->get();
        }

        return $data;
    }

    public function handleGetSupervisorById($id)
    {
        // dd($this->user->find($id));
        $data = $this->supervisor->find($id);
        return $data;
    }

    public function handleGetSupervisorStudent()
    {
        $data = $this->student->where('supervisor_id', Auth::user()->supervisor->id)->get();
        return $data;
    }

    public function handlePostStoreSupervisor($request)
    {
        // Supervisor
        $reqSupervisor = $request->validate([
            'phone' => 'required',
            'emergency_contact' => 'nullable',
            'division' => 'required',
            'department' => 'required',
            'job_role' => 'required',
        ]); 
        $reqSupervisor['status'] = 'active';
        $dataSupervisor = $this->supervisor->create($reqSupervisor);

        // User
        $reqUser = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]); 
        // $reqUser['name'] = strtolower($request->name);
        $reqUser['name'] = ucwords(trans($request->name));
        $reqUser['supervisor_id'] = $dataSupervisor->id;
        $reqUser['password'] = bcrypt($request->password);
        $reqUser['status'] = 'active';
        $dataUser = $this->user->create($reqUser);
    }

    public function handlePutUpdateSupervisor($request, $id)
    {
        // Supervisor
        $reqSupervisor = $request->validate([
            'phone' => 'required',
            'emergency_contact' => 'nullable',
            'division' => 'required',
            'department' => 'required',
            'job_role' => 'required',
            'status' => 'required'
        ]); 
        $this->supervisor->find($id)->update($reqSupervisor);

        $reqUser = $request->validate([
            'status' => 'required',
            'name' => 'required'
        ]);
        $this->user->where('supervisor_id', $id)->update($reqUser);
    }

    public function handlePutStatusSupervisor($id)
    {
        $data = $this->supervisor->find($id);
        
        if ($data->status == 'active') {
            $status = 'inactive';
        } else {
            $status = 'active';
        }

        $this->supervisor->find($id)->update([
            'status' => $status,
        ]);

        $this->user->where('supervisor_id', $id)->update([
            'status' => $status
        ]);

        return 'okayy!';
    }
}