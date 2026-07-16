<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeritageSite;
use Illuminate\Support\Str;

class HeritageSiteSeeder extends Seeder
{
    public function run(): void
    {
        $sites = [
            [
                'site_category_id' => 1,
                'name' => 'Candi Prambanan',
                'slug' => Str::slug('Candi Prambanan'),
                'description' => 'Kompleks candi Hindu terbesar di Indonesia yang dibangun pada abad ke-9.',
                'address' => 'Jl. Raya Solo - Yogyakarta No.16, Kranggan, Bokoharjo, Prambanan, Sleman',
                'latitude' => -7.7520206,
                'longitude' => 110.4892787,
                'operating_hours' => json_encode(['Senin-Minggu' => '06:00-17:00']),
                'admission_fee' => 50000,
                'registration_number' => 'CB.01.01',
                'designation_year' => '1991',
                'status' => 'active',
                'is_facility_available' => true,
                'created_by' => 1, // Admin Utama
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'site_category_id' => 2,
                'name' => 'Keraton Yogyakarta',
                'slug' => Str::slug('Keraton Yogyakarta'),
                'description' => 'Istana resmi Kesultanan Ngayogyakarta Hadiningrat yang kini berlokasi di Kota Yogyakarta.',
                'address' => 'Jl. Rotowijayan Blok No. 1, Panembahan, Kraton, Kota Yogyakarta',
                'latitude' => -7.8052845,
                'longitude' => 110.3642031,
                'operating_hours' => json_encode(['Senin-Minggu' => '08:00-14:00']),
                'admission_fee' => 15000,
                'registration_number' => 'CB.02.01',
                'designation_year' => '1995',
                'status' => 'active',
                'is_facility_available' => true,
                'created_by' => 2, // Budi Site Manager
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'site_category_id' => 3,
                'name' => 'Masjid Gedhe Kauman',
                'slug' => Str::slug('Masjid Gedhe Kauman'),
                'description' => 'Masjid raya Kesultanan Yogyakarta, atau Masjid Besar Yogyakarta.',
                'address' => 'Alun-Alun Keraton, Jl. Kauman, Ngupasan, Gondomanan, Kota Yogyakarta',
                'latitude' => -7.8038880,
                'longitude' => 110.3622220,
                'operating_hours' => json_encode(['Senin-Minggu' => '24 Jam']),
                'admission_fee' => 0,
                'registration_number' => 'CB.03.01',
                'designation_year' => '2000',
                'status' => 'active',
                'is_facility_available' => true,
                'created_by' => 1, // Admin Utama
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        HeritageSite::insert($sites);
    }
}
