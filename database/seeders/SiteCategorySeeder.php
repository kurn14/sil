<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteCategory;
use Illuminate\Support\Str;

class SiteCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => ['id' => 'Candi', 'en' => 'Temple'],
                'slug' => Str::slug('Candi'),
                'description' => ['id' => 'Bangunan purbakala yang berasal dari zaman Hindu-Buddha.', 'en' => 'Ancient buildings dating back to the Hindu-Buddhist era.'],
                'icon' => 'candi-icon.png',
            ],
            [
                'name' => ['id' => 'Keraton', 'en' => 'Palace'],
                'slug' => Str::slug('Keraton'),
                'description' => ['id' => 'Istana tempat kediaman raja atau ratu beserta keluarganya.', 'en' => 'The palace where the king or queen and their family reside.'],
                'icon' => 'keraton-icon.png',
            ],
            [
                'name' => ['id' => 'Masjid Kuno', 'en' => 'Ancient Mosque'],
                'slug' => Str::slug('Masjid Kuno'),
                'description' => ['id' => 'Tempat ibadah peninggalan masa kerajaan Islam.', 'en' => 'A place of worship left from the Islamic kingdom era.'],
                'icon' => 'masjid-icon.png',
            ],
        ];

        // Create icons directory if it doesn't exist
        if (!\Illuminate\Support\Facades\Storage::disk('public')->exists('icons')) {
            \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory('icons');
        }

        foreach ($categories as $category) {
            $iconPath = 'icons/' . $category['icon'];
            if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($iconPath)) {
                try {
                    $imageContent = file_get_contents('https://picsum.photos/100/100');
                    if ($imageContent) {
                        \Illuminate\Support\Facades\Storage::disk('public')->put($iconPath, $imageContent);
                    }
                } catch (\Exception $e) {
                    // Fail silently
                }
            }
            $category['icon'] = $iconPath;

            SiteCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
