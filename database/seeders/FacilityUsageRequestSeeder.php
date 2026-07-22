<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FacilityUsageRequest;

class FacilityUsageRequestSeeder extends Seeder
{
    public function run(): void
    {
        $requests = [
            [
                'request_number' => 'REQ-202607-001',
                'applicant_id' => 1, // Eko Applicant
                'heritage_site_id' => 1, // Prambanan
                'identity_number' => '3471234567890001',
                'institution_name' => 'Universitas Indonesia',
                'activity_type' => 'Penelitian Akademik',
                'activity_description' => 'Penelitian mengenai struktur bangunan candi',
                'start_date' => '2026-08-01',
                'end_date' => '2026-08-05',
                'duration_days' => 5,
                'participant_count' => 3,
                'application_letter_path' => 'docs/req-001.pdf',
                'status' => 'approved',
                'approval_notes' => 'Disetujui untuk area luar candi',
                'permit_number' => 'PRM-202607-001',
                'fee_amount' => 0,
                'reviewed_by' => 2, // Budi Site Manager
                'reviewed_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            $createdAt = $faker->dateTimeBetween('2025-01-01', '2026-07-31');
            $startDate = (clone $createdAt)->modify('+' . $faker->numberBetween(1, 30) . ' days');
            $duration = $faker->numberBetween(1, 7);
            $endDate = (clone $startDate)->modify('+' . $duration . ' days');
            
            $statuses = ['submitted', 'verified', 'approved', 'rejected', 'completed', 'cancelled'];
            $status = $faker->randomElement($statuses);

            $requests[] = [
                'request_number' => 'REQ-' . $createdAt->format('Ym') . '-' . str_pad($faker->unique()->numberBetween(2, 999), 3, '0', STR_PAD_LEFT),
                'applicant_id' => $faker->numberBetween(1, 52), // Assuming we have up to 52 applicants
                'heritage_site_id' => $faker->numberBetween(1, 2), // Assuming we have 2 sites (Prambanan, Borobudur)
                'identity_number' => $faker->nik,
                'institution_name' => $faker->company,
                'activity_type' => $faker->randomElement(['Penelitian Akademik', 'Dokumentasi', 'Kunjungan Khusus', 'Acara Kebudayaan']),
                'activity_description' => $faker->sentence,
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                'duration_days' => $duration,
                'participant_count' => $faker->numberBetween(1, 50),
                'application_letter_path' => 'docs/req-' . $faker->uuid . '.pdf',
                'status' => $status,
                'approval_notes' => in_array($status, ['approved', 'rejected']) ? $faker->sentence : null,
                'permit_number' => $status === 'approved' || $status === 'completed' ? 'PRM-' . $createdAt->format('Ym') . '-' . str_pad($faker->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT) : null,
                'fee_amount' => $faker->randomElement([0, 500000, 1000000, 2000000]),
                'reviewed_by' => in_array($status, ['verified', 'approved', 'rejected', 'completed']) ? 2 : null,
                'reviewed_at' => in_array($status, ['verified', 'approved', 'rejected', 'completed']) ? (clone $createdAt)->modify('+' . $faker->numberBetween(1, 3) . ' days') : null,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        FacilityUsageRequest::insert($requests);
    }
}
