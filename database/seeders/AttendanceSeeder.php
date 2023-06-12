<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // foreach (range(1,4) as $number) {
        //     $sub[] = $number;
        // }
        // $student_id = [2, 3, 4, 5, 6, 7, 8];
        // $att_type = ['pending', 'present', 'reject'];
        // for($i = 1; $i <= 499; $i++)
        // {
        //     Attendance::create([
        //         'id' => $i,
        //         'user_id' => $student_id[array_rand($student_id)],
        //         'clock_in' => Carbon::now()->subDays($sub[array_rand($sub)])->format('d-m-Y H:i:s'),
        //         'work_type' => 'WFO',
        //         'attendance_type' => $att_type[array_rand($att_type)],
        //         'status' => 'active',
        //     ]);
        // }
    }
}
