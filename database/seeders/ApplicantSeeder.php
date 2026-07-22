<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Applicant;
use Illuminate\Support\Facades\Hash;

class ApplicantSeeder extends Seeder
{
    public function run(): void
    {
        $applicants = [
            [
                'name' => 'Eko Applicant',
                'email' => 'eko@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '081234567890',
                'nik' => '3471234567890001',
                'address' => 'Jl. Kebon Raya No 12, Yogyakarta',
                'institution_name' => 'Universitas Indonesia',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rina Applicant',
                'email' => 'rina@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '081298765432',
                'nik' => '3471234567890002',
                'address' => 'Jl. Merdeka No 45, Jakarta',
                'institution_name' => 'Lembaga Ilmu Pengetahuan',
                'email_verified_at' => now(),
            ],
        ];

        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            $createdAt = $faker->dateTimeBetween('-3 months', 'now');
            
            $applicants[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'phone_number' => $faker->phoneNumber,
                'nik' => $faker->nik,
                'address' => $faker->address,
                'institution_name' => $faker->company,
                'email_verified_at' => $createdAt,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        foreach ($applicants as $applicant) {
            Applicant::firstOrCreate(
                ['email' => $applicant['email']],
                $applicant
            );
        }
    }
}
