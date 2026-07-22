<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteConditionReport;

class SiteConditionReportSeeder extends Seeder
{
    public function run(): void
    {
        $reports = [
            [
                'heritage_site_id' => 1, // Prambanan
                'surveyor_id' => 2, // Budi Site Manager
                'survey_date' => '2026-07-10',
                'condition' => 'minor_damage',
                'findings' => 'Terdapat lumut di beberapa batuan candi perwara',
                'recommendation' => 'Pembersihan mekanis secara berkala',
                'is_urgent' => false,
                'responded_by' => 4, // Agus Leader
                'responded_at' => now(),
                'response_notes' => 'Jadwalkan pembersihan minggu depan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            $createdAt = $faker->dateTimeBetween('2025-01-01', '2026-07-31');
            $surveyDate = (clone $createdAt)->modify('-' . $faker->numberBetween(0, 5) . ' days');
            
            $conditions = ['good', 'minor_damage', 'moderate_damage', 'severe_damage'];
            $condition = $faker->randomElement($conditions);

            $isUrgent = in_array($condition, ['moderate_damage', 'severe_damage']) ? $faker->boolean(80) : $faker->boolean(10);
            $hasResponse = $faker->boolean(70);

            $reports[] = [
                'heritage_site_id' => $faker->numberBetween(1, 2), // Assuming we have 2 sites
                'surveyor_id' => 2, // Assuming ID 2 is Budi Site Manager
                'survey_date' => $surveyDate->format('Y-m-d'),
                'condition' => $condition,
                'findings' => $faker->paragraph,
                'recommendation' => $faker->sentence,
                'is_urgent' => $isUrgent,
                'responded_by' => $hasResponse ? 4 : null, // Assuming ID 4 is Agus Leader
                'responded_at' => $hasResponse ? (clone $createdAt)->modify('+' . $faker->numberBetween(1, 7) . ' days') : null,
                'response_notes' => $hasResponse ? $faker->sentence : null,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        SiteConditionReport::insert($reports);
    }
}
