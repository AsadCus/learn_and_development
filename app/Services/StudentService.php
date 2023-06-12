<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use App\Models\Document;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class StudentService
{
    public function __construct(Student $student, User $user, Institute $institute, Document $document)
    {
        $this->student = $student;
        $this->user = $user;
        $this->institute = $institute;
        $this->document = $document;
    }
    
    public function handleGetAllStudent($request)
    {
        $param_show_active = $request->input('show_active');
        $param_show_inactive = $request->input('show_inactive');
        
        if ($param_show_active == 'true') {
            $show_active = 'active';
        } else {
            $show_active = null;
        }
        if ($param_show_inactive == 'true') {
            $show_inactive = 'inactive';
        } else {
            $show_inactive = null;
        }

        if ($show_active == null && $show_inactive == null) {
            $show_active = 'active';
        }
        
        $status = [$show_active, $show_inactive];

        $fromDate = $request->input('start_date');
        $toDate = $request->input('end_date');

        if ($fromDate) {
            $data = $this->student->whereBetween('start_date', [$fromDate, $toDate])
            ->get();
        } else {
            $data = $this->student
            ->when($status, function ($query, $status){return $query->whereIn('status', $status);})
            ->get();
        }
        
        return $data;
    }

    public function handleGetUpcomingEndStudent()
    {
        $data = $this->student->orderBy('end_date', 'asc')->get();
        return $data;
    }

    public function handleGetByStudent($id){
        $data = $this->student->find($id);
        return $data;
    }

    public function handleGetProfile()
    {
        $data = $this->user->with('student')->where('id', Auth::user()->id)->get();
        return $data;
    }

    public function handleGetAllDocument()
    {
        $data = $this->document->get();
        return $data;
    }

    public function handlePIC(){
        $data = $this->user->with('student')->where('id', Auth::user()->id)->first();
        $supervisorId = $data->student->supervisor_id;
        $dataSupervisor = $this->user->with('supervisor')->whereHas('supervisor', function($q) use($supervisorId){
            $q->where('id', $supervisorId);
        })->first();
        $p = $dataSupervisor->name;
        return $p;
    }

    public function handlePostStoreStudent($request)
    {
        // Student
        $reqStudent = $request->validate([
            'phone' => 'required',            
            'supervisor_id' => 'required',
            'division' => 'required',
            'department' => 'required',
            'job_role' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]); 
        $reqStudent['status'] = 'active';
        $dataStudent = $this->student->create($reqStudent);

        // User
        $reqUser = $request->validate([
            'name' => 'required',
            'nik' => 'unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]); 
        // $reqUser['name'] = strtolower($request->name);
        $reqUser['name'] = ucwords(trans($request->name));
        $reqUser['student_id'] = $dataStudent->id;
        $reqUser['password'] = bcrypt($request->password);
        $reqUser['status'] = 'active';
        $dataUser = $this->user->create($reqUser);
    }

    public function handlePutUpdateStudent($request, $id)
    {
        // dd($request);
        $reqStatus = $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);
        $this->user->where('student_id', $id)->first()->update($reqStatus);
        $reqStudent = $request->validate([
            'phone' => 'required',            
            'supervisor_id' => 'required',
            'division' => 'required',
            'department' => 'required',
            'job_role' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'institute_id' => 'nullable',
            'major' => 'nullable',
            'ipk' => 'nullable|between:0,4.00',
            'address' => 'nullable',
            'emergency_contact' => 'nullable',
            'cv' => 'nullable',
            'status' => 'nullable'
        ]); 
        $this->student->find($id)->update($reqStudent);
    }

    public function handlePutStatusStudent($id)
    {
        $data = $this->student->find($id);
        
        if ($data->status == 'active') {
            $status = 'deactive';
        } else {
            $status = 'active';
        }

        $this->student->find($id)->update([
            'status' => $status,
        ]);

        $this->user->where('student_id', $id)->update([
            'status' => $status
        ]);

        return 'okay!!';
    }

    public function handleGetEditStudentById($id){
        $data = $this->student->find($id);
        return $data;
    }

    public function handlePutUpdateStudentByStudent($request, $id)
    {
        // dd($request->name);  
        $reqStudent = $request->validate([
            'nik' => 'nullable',
            'major' => 'nullable',
            'ipk' => 'nullable|between:0,4.00',
            'address' => 'nullable',
            'phone' => 'required',
            'emergency_contact' => 'nullable',
        ]); 
        $this->student->find($id)->update($reqStudent);
        
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,svg|max:5120'
        ]);
        if ($request->hasfile('image')) {            
            $file = str_replace(' ','-',$request->file('image')->getClientOriginalName());
            $filename = Carbon::now()->format('Hisdmy').'_'.$file;
            $request->file('image')->move(public_path('profile'), $filename);
            $this->user->where('student_id', $id)->first()->update([
                'image' => $filename,
            ]);
        }
        $this->user->where('student_id', $id)->first()->update([
            'name' => $request->name
        ]);
        return 'data stored';
    }

    public function handlePostCV($request, $id)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf|max:10240'
        ]);
        // dd($request);
        if ($request->hasFile('cv')) {            
            $file = str_replace(' ','-',$request->file('cv')->getClientOriginalName());
            $filename = Carbon::now()->format('Hisdmy').'_'.$file;
            $request->file('cv')->move(public_path('files'), $filename);
            $this->student->find($id)->update([
                'cv' => $filename,
            ]);
        }
        return 'data has been store';
        
    }

    public function handleDeleteCV($id)
    {         
        $data = $this->student->find($id);
        $path = public_path("files/".$data->cv);

        // hapus file di storage
        if (File::exists($path)) {
            File::delete($path);
        }
       
        // hapus data db
        if ($data->cv != null) {
            $status = null;
        }
        $updateData = $data->update([
            'cv' => $status,
        ]);

        return $updateData;
    }

    // upload FILE
    public function handleUploadFile($request)
    {
        $request->validate([
            'document' => 'required|max:10240',
            'type' => 'required',
            'student_id' => 'required'
        ]);
        if ($request->hasFile('document')) {            
            $file = str_replace(' ','-',$request->file('document')->getClientOriginalName());
            $filename = Carbon::now()->format('Hisdmy').'_'.$file;
            $request->file('document')->move(public_path('files'), $filename);
            $this->document->create([
                'document' => $filename,
                'type' => $request->type,
                'student_id' => $request->student_id,
            ]);
        }

        return 'data has been store';
    }

    public function handleDeleteFile($id)
    {
        $data = $this->document->find($id);
        $path = public_path("files/".$data->document);

        // hapus file di storage
        if (File::exists($path)) {
            File::delete($path);
        }
       
        // hapus data db
        $destroy = $this->document->find($id)->delete();

        return $destroy;
    }
}