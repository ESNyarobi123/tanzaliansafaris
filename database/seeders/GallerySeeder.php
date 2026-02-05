<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            [
                'title' => 'Serengeti Sunset',
                'subtitle' => 'Golden hour in the endless plains',
                'image_path' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'status' => 'active',
            ],
            [
                'title' => 'Elephant Family',
                'subtitle' => 'Majestic giants of Tarangire',
                'image_path' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'status' => 'active',
            ],
            [
                'title' => 'Lion King',
                'subtitle' => 'The ruler of Serengeti',
                'image_path' => 'https://images.unsplash.com/photo-1523805009345-7448845a9e53?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'status' => 'active',
            ],
            [
                'title' => 'Zanzibar Beach',
                'subtitle' => 'Paradise on earth',
                'image_path' => 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'status' => 'active',
            ],
            [
                'title' => 'Giraffe Portrait',
                'subtitle' => 'Graceful beauty of the savanna',
                'image_path' => 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'status' => 'active',
            ],
            [
                'title' => 'Mount Kilimanjaro',
                'subtitle' => "Africa's rooftop",
                'image_path' => 'https://images.unsplash.com/photo-1551009175-8a68da93d5f9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'status' => 'active',
            ],
        ];

        foreach ($images as $image) {
            Gallery::create($image);
        }
    }
}
