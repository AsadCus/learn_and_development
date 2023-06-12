<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@learnDev',
                'password' => bcrypt('12345'),
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'student_id' => 1,
                'name' => 'Student1',
                'nik' => '65654343',
                'email' => 'student1@learnDev',
                'password' => bcrypt('12345'),
                'role' => 'student',
                'status' => 'active',
            ],
            [
                'student_id' => 2,
                'name' => 'Student2',
                'nik' => '45623456789',
                'email' => 'student2@learnDev',
                'password' => bcrypt('12345'),
                'role' => 'student',
                'status' => 'inactive',
            ],
            [
                'student_id' => 3,
                'name' => 'Student3',
                'nik' => '876543456',
                'email' => 'student3@learnDev',
                'password' => bcrypt('12345'),
                'role' => 'student',
                'status' => 'active',
            ],
            [
                'student_id' => 4,
                'name' => 'Student4',
                'nik' => '23456781',
                'email' => 'student4@learnDev',
                'password' => bcrypt('12345'),
                'role' => 'student',
                'status' => 'active',
            ],
            [
                'student_id' => 5,
                'name' => 'Student5',
                'nik' => '98765434567',
                'email' => 'student5@learnDev',
                'password' => bcrypt('12345'),
                'role' => 'student',
                'status' => 'active',
            ],
            [
                'student_id' => 6,
                'name' => 'Student6',
                'nik' => '3567482',
                'email' => 'student6@learnDev',
                'password' => bcrypt('12345'),
                'role' => 'student',
                'status' => 'active',
            ],
            [
                'student_id' => 7,
                'name' => 'Student7',
                'nik' => '93883343',
                'email' => 'student7@learnDev',
                'password' => bcrypt('12345'),
                'role' => 'student',
                'status' => 'active',
            ],
            [
                'supervisor_id' => 1,
                'name' => 'Supervisor1',
                'nik' => '54567897654',
                'email' => 'supervisor1@learnDev',
                'password' => bcrypt('12345'),
                'role' => 'supervisor',
                'status' => 'active',
            ],
            [
                'supervisor_id' => 2,
                'name' => 'Supervisor2',
                'nik' => '34567898765',
                'email' => 'supervisor2@learnDev',
                'password' => bcrypt('12345'),
                'role' => 'supervisor',
                'status' => 'active',
            ],
            [
                'supervisor_id' => 3,
                'name' => 'Supervisor3',
                'nik' => '098392387438',
                'email' => 'supervisor3@learnDev',
                'password' => bcrypt('12345'),
                'role' => 'supervisor',
                'status' => 'active',
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
