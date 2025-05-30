<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Women\'s',
            'description' => 'Koleksi pakaian wanita terbaik',
            'image_url' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748530084/1747472974_pexels-castorlystock-3682293_fpr1rs.jpg',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 12:24:55'
        ]);

        Category::create([
            'name' => 'Men\'s',
            'description' => 'Koleksi pakaian pria terbaik',
            'image_url' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748530078/1747472906_pexels-solliefoto-298863_imb1df.jpg',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 12:24:55'
        ]);

        Category::create([
            'name' => 'Health & Beauty',
            'description' => 'Health & Beauty collection',
            'image_url' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748530107/1747472831_pexels-n-voitkevich-8468019_wesgyg.jpg',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 12:24:55'
        ]);

        Category::create([
            'name' => 'Babies & Kids',
            'description' => 'Koleksi pakaian bayi dan anak-anak',
            'image_url' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748530075/1747472620_asmund-gimre-NrJA1TPi0P8-unsplash_cmsv1s.jpg',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 12:24:55'
        ]);

        Category::create([
            'name' => 'Luxury',
            'description' => 'Koleksi barang mewah dan eksklusif',
            'image_url' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748530100/1747472874_pexels-nappy-1058959_la9vc7.jpg',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 12:24:55'
        ]);

        Category::create([
            'name' => 'Electronics',
            'description' => 'Koleksi elektronik dan gadget',
            'image_url' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748530075/1747472684_pexels-pixabay-356056_tw5pgh.jpg',
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 12:24:55'
        ]);
    }
} 