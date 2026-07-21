<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SitePhoto;
use App\Models\HeritageSite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SitePhotoSeeder extends Seeder
{
    public function run(): void
    {
        // Create photos directory if it doesn't exist
        if (!Storage::disk('public')->exists('photos')) {
            Storage::disk('public')->makeDirectory('photos');
        }

        $sites = HeritageSite::all();

        foreach ($sites as $site) {
            $numPhotos = rand(3, 6);
            
            for ($i = 1; $i <= $numPhotos; $i++) {
                $filename = 'photos/' . $site->slug . '-' . $i . '-' . Str::random(4) . '.jpg';
                
                // Download a dummy image
                try {
                    $imageContent = file_get_contents('https://picsum.photos/800/600?random=' . uniqid());
                    if ($imageContent) {
                        Storage::disk('public')->put($filename, $imageContent);
                    }
                } catch (\Exception $e) {
                    // Fail silently or handle if no internet
                }

                $nameId = $site->getTranslation('name', 'id') ?: $site->name;
                $nameEn = $site->getTranslation('name', 'en') ?: $site->name;

                SitePhoto::updateOrCreate(
                    [
                        'heritage_site_id' => $site->id,
                        'sort_order' => $i
                    ],
                    [
                        'file_path' => $filename,
                        'caption' => [
                            'id' => 'Foto ' . $i . ' untuk ' . $nameId,
                            'en' => 'Photo ' . $i . ' for ' . $nameEn
                        ],
                        'is_featured' => $i === 1,
                    ]
                );
            }
        }
    }
}
