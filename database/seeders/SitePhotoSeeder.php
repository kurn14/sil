<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SitePhoto;

class SitePhotoSeeder extends Seeder
{
    public function run(): void
    {
        $photos = [
            [
                'heritage_site_id' => 1,
                'file_path' => 'photos/prambanan-1.jpg',
                'caption' => ['id' => 'Tampak depan Candi Prambanan', 'en' => 'Front view of Prambanan Temple'],
                'sort_order' => 1,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'heritage_site_id' => 2,
                'file_path' => 'photos/keraton-1.jpg',
                'caption' => ['id' => 'Pelataran Keraton Yogyakarta', 'en' => 'Yogyakarta Palace courtyard'],
                'sort_order' => 1,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'heritage_site_id' => 3,
                'file_path' => 'photos/masjid-kauman-1.jpg',
                'caption' => ['id' => 'Serambi Masjid Gedhe Kauman', 'en' => 'Porch of Gedhe Kauman Mosque'],
                'sort_order' => 1,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($photos as $photo) {
            SitePhoto::updateOrCreate(
                ['heritage_site_id' => $photo['heritage_site_id'], 'file_path' => $photo['file_path']],
                $photo
            );
        }
    }
}
