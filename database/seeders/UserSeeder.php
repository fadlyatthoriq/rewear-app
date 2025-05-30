<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@rewear.com',
            'email_verified_at' => '2025-05-29 12:24:52',
            'password' => '$2y$12$f7xckeG6II9XeFzT98hWce15ST1rm8zBIbk.eeVa2EiVLyrUfplGq',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1',
            'birth_date' => '1990-01-01',
            'role' => 'admin',
            'profile_picture' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527264/profiles/vgzzewwq1ve4oj9pc33d.png',
            'is_seller' => 0,
            'store_name' => null,
            'store_description' => null,
            'remember_token' => null,
            'created_at' => '2025-05-29 12:24:52',
            'updated_at' => '2025-05-29 12:24:52'
        ]);

        // Create regular user
        User::create([
            'name' => 'User',
            'email' => 'user@rewear.com',
            'email_verified_at' => '2025-05-29 12:24:52',
            'password' => '$2y$12$T3pXiwTYvkc1rht9gBL4Uez8oTdrlbdJLw5.tzfJn1cYkuDPmMTE6',
            'phone' => '089876543210',
            'address' => 'Jl. User No. 1',
            'birth_date' => '1992-05-15',
            'role' => 'user',
            'profile_picture' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527264/profiles/vgzzewwq1ve4oj9pc33d.png',
            'is_seller' => 0,
            'store_name' => null,
            'store_description' => null,
            'remember_token' => null,
            'created_at' => '2025-05-29 12:24:52',
            'updated_at' => '2025-05-29 12:24:52'
        ]);

        // Create seller users
        User::create([
            'name' => 'Fashion Store',
            'email' => 'fashion@rewear.com',
            'email_verified_at' => '2025-05-29 12:24:52',
            'password' => '$2y$12$NDPQugFQJ2jCJppyfyzioehoybuEHNFoK4XE7wAs1h4bccxPTjGtS',
            'phone' => '081234567893',
            'address' => 'Jl. Fashion Store No. 1',
            'birth_date' => '1988-06-20',
            'role' => 'user',
            'profile_picture' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527581/profiles/prmji0fyfqw4hghzjgy4.png',
            'is_seller' => 1,
            'store_name' => 'Fashion Store',
            'store_description' => 'Toko fashion terpercaya dengan koleksi terbaru',
            'remember_token' => null,
            'created_at' => '2025-05-29 12:24:52',
            'updated_at' => '2025-05-29 12:24:52'
        ]);

        User::create([
            'name' => 'Vintage Shop',
            'email' => 'vintage@rewear.com',
            'email_verified_at' => '2025-05-29 12:24:53',
            'password' => '$2y$12$672TuS/v0CmIqN7.dbCajOabWSpglDMBrJcK3vj17/i.kdazW1Qai',
            'phone' => '081234567894',
            'address' => 'Jl. Vintage Shop No. 1',
            'birth_date' => '1991-09-15',
            'role' => 'user',
            'profile_picture' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527581/profiles/prmji0fyfqw4hghzjgy4.png',
            'is_seller' => 1,
            'store_name' => 'Vintage Shop',
            'store_description' => 'Koleksi pakaian vintage berkualitas',
            'remember_token' => null,
            'created_at' => '2025-05-29 12:24:53',
            'updated_at' => '2025-05-29 12:24:53'
        ]);

        User::create([
            'name' => 'Luxury Boutique',
            'email' => 'luxury@rewear.com',
            'email_verified_at' => '2025-05-29 12:24:53',
            'password' => '$2y$12$4q.vwtrNqF1FxGHlyLpWPuAOnL85P2V8CW3zYpH9dNfU5XwyTRqUW',
            'phone' => '081234567895',
            'address' => 'Jl. Luxury Boutique No. 1',
            'birth_date' => '1985-03-10',
            'role' => 'user',
            'profile_picture' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527581/profiles/prmji0fyfqw4hghzjgy4.png',
            'is_seller' => 1,
            'store_name' => 'Luxury Boutique',
            'store_description' => 'Koleksi barang mewah dan eksklusif',
            'remember_token' => null,
            'created_at' => '2025-05-29 12:24:53',
            'updated_at' => '2025-05-29 12:24:53'
        ]);

        User::create([
            'name' => 'Sporty Style',
            'email' => 'sporty@rewear.com',
            'email_verified_at' => '2025-05-29 12:24:54',
            'password' => '$2y$12$xo.NFEqZMdT1uV0l/DLS6.9ZTsNj7.JaGCtMUSryTr2aRyTO7zfky',
            'phone' => '081234567896',
            'address' => 'Jl. Sporty Style No. 1',
            'birth_date' => '1993-11-25',
            'role' => 'user',
            'profile_picture' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527581/profiles/prmji0fyfqw4hghzjgy4.png',
            'is_seller' => 1,
            'store_name' => 'Sporty Style',
            'store_description' => 'Koleksi pakaian olahraga dan casual sporty',
            'remember_token' => null,
            'created_at' => '2025-05-29 12:24:54',
            'updated_at' => '2025-05-29 12:24:54'
        ]);

        User::create([
            'name' => 'Kids Fashion',
            'email' => 'kids@rewear.com',
            'email_verified_at' => '2025-05-29 12:24:54',
            'password' => '$2y$12$aEDCcERF9TFM5xNyGDHyEuunevikzUt/NkA053y6rIHNDn4t5QxvS',
            'phone' => '081234567897',
            'address' => 'Jl. Kids Fashion No. 1',
            'birth_date' => '1990-07-18',
            'role' => 'user',
            'profile_picture' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527581/profiles/prmji0fyfqw4hghzjgy4.png',
            'is_seller' => 1,
            'store_name' => 'Kids Fashion',
            'store_description' => 'Koleksi pakaian anak-anak yang lucu dan nyaman',
            'remember_token' => null,
            'created_at' => '2025-05-29 12:24:54',
            'updated_at' => '2025-05-29 12:24:54'
        ]);

        User::create([
            'name' => 'Beauty Store',
            'email' => 'beauty@rewear.com',
            'email_verified_at' => '2025-05-29 12:24:55',
            'password' => '$2y$12$DRpEZsYbx2cfus6kQeMJxOU15UWFOWZsJOeicEW9M8Ibea6CkbH0y',
            'phone' => '081234567898',
            'address' => 'Jl. Beauty Store No. 1',
            'birth_date' => '1992-04-12',
            'role' => 'user',
            'profile_picture' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527581/profiles/prmji0fyfqw4hghzjgy4.png',
            'is_seller' => 1,
            'store_name' => 'Beauty Store',
            'store_description' => 'Koleksi produk kecantikan dan perawatan kulit terbaik',
            'remember_token' => null,
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 12:24:55'
        ]);

        // Create additional test user
        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'email_verified_at' => '2025-05-29 12:24:55',
            'password' => '$2y$12$U9x2U8qhwQbK.AhSic6PrucqMpgG549bxRvMZE9o70bYFANuKsKmq',
            'phone' => '081234567892',
            'address' => 'Jl. Jane Smith No. 1',
            'birth_date' => '1993-07-10',
            'role' => 'user',
            'profile_picture' => 'https://res.cloudinary.com/du3v8hhr2/image/upload/v1748527264/profiles/vgzzewwq1ve4oj9pc33d.png',
            'is_seller' => 0,
            'store_name' => null,
            'store_description' => null,
            'remember_token' => null,
            'created_at' => '2025-05-29 12:24:55',
            'updated_at' => '2025-05-29 12:24:55'
        ]);
    }
} 