<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\institute;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class instituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institute = [
            [
                'name' => 'Universitas Indonesia',
                'type' => 'universitas',
                'accreditation' => 'A',
                'website' => 'www.ui.ac.id',
                'email' => 'humas@ui.ac.id',
                'phone' => '0211500002',
                'address' => 'depok',
                'status' => 'active',
            ],
            [
                'name' => 'Institut Teknologi Bandung',
                'type' => 'institut',
                'accreditation' => 'A',
                'website' => 'www.itb.ac.id',
                'email' => 'humas@itb.ac.id',
                'phone' => '0222500935',
                'address' => 'bandung',
                'status' => 'active',
            ],
            [
                'name' => 'Bina Nusantara institute',
                'type' => 'universitas',
                'accreditation' => 'A',
                'website' => 'www.binus.ac.id',
                'email' => 'pmb@binus.edu',
                'phone' => '0215345830',
                'address' => 'jakarta',
                'status' => 'active',
            ],
            [
                'name' => 'Telkom institute',
                'type' => 'universitas',
                'accreditation' => 'A',
                'website' => 'www.telkominstitute.ac.id',
                'email' => 'info@telkominstitute.ac.id',
                'phone' => '0227564108',
                'address' => 'jakarta',
                'status' => 'active',
            ],
        ];

        foreach ($institute as $key => $value) {
            institute::create($value);
        }
    }
}
