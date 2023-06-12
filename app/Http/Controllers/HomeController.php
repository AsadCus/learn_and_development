<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ScoreService;
use Illuminate\Http\Request;
use App\Services\StudentService;
use App\Services\SupervisorService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StudentService $studentService, SupervisorService $supervisorService, ScoreService $scoreService)
    {
        $this->middleware('auth');
        $this->studentService = $studentService;
        $this->supervisorService = $supervisorService;
        $this->scoreService = $scoreService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // $notifications =  $this->notificationService->handleAllNotification();
        if (Auth::user()->role == 'student') {
            return redirect()->route('profile.student');
        }

        if (Auth::user()->role == 'supervisor') {
            return redirect()->route('profile.supervisor');
        }

        if (Auth::user()->role == 'admin') {
            $upcomingstudents = $this->studentService->handleGetUpcomingEndStudent();
            $students = $this->studentService->handleGetAllStudent($request);
            $supervisors = $this->supervisorService->handleGetAllSupervisor($request);
            $scores =$this->scoreService->handleGetAllScoreResult();
            return view('master.dashboard', [
                'upcomingstudents' => $upcomingstudents,
                'students' => $students,
                'supervisors' => $supervisors,
                'scores' => $scores,
            ]);
        }

        // return view('home', ['notifications' => $notifications]);
    }

    public function changePassword()
    {
        $data = Auth::user()->password;
        return view('layouts.change-password',[
            'password' => $data
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
    
        //Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
    
        return redirect()->back();
    }

    public function editProfile()
    {
        return view('master.edit', [
            // 'data' => $data
        ]);
    }

    public function updateProfile(Request $request, $id)
    {
        $data = User::find($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,svg|max:5120'
        ]);

        if ($request->hasfile('image')) {            
            $filename = str_replace(' ','-',$request->file('image')->getClientOriginalName());
            $request->file('image')->move(public_path('profile'), $filename);
            User::find($id)->first()->update([
                'image' => $filename,
            ]);
        }

        $data->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->back();
    }

    public function image($id)
    {
        $data = User::find($id);
        $path = public_path("files/".$data->image);

        // hapus file di storage
        if (File::exists($path)) {
            File::delete($path);
        }
       
        // hapus data db
        if ($data->image != null) {
            $image = null;
        }
        $updateData = $data->update([
            'image' => $image,
        ]);

        return redirect()->back();
    }

}
