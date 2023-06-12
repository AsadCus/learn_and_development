<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Supervisor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supervisor = [
            [
                'phone' => '081234567890',
                'emergency_contact' => '081234567891',
                'division' => 'development application web base',
                'department' => 'PT.MNC',
                'job_role' => 'product management',
                'status' => 'active',
            ],
            [
                'phone' => '081234567890',
                'emergency_contact' => '081234567891',
                'division' => 'development application web base',
                'department' => 'PT.MNC',
                'job_role' => 'product management',
                'status' => 'active',
            ],
            [
                'phone' => '081234567890',
                'emergency_contact' => '081234567891',
                'division' => 'development application web base',
                'department' => 'PT.MNC',
                'job_role' => 'sales manager',
                'status' => 'active',
            ],
        ];

        foreach ($supervisor as $key => $value) {
            Supervisor::create($value);
        }
    }
}
