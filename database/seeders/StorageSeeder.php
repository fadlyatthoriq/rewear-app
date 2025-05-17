<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class StorageSeeder extends Seeder
{
    public function run()
    {
        // Create storage directory if it doesn't exist
        $storagePath = storage_path('app/public');
        if (!File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0755, true);
        }

        // Copy default files from seeder storage to actual storage
        $seederStoragePath = database_path('seeders/storage');
        if (File::exists($seederStoragePath)) {
            File::copyDirectory($seederStoragePath, $storagePath);
        }

        // Create symbolic link if it doesn't exist
        $publicPath = public_path('storage');
        if (!File::exists($publicPath)) {
            $this->command->info('Creating symbolic link...');
            $this->command->call('storage:link');
        }
    }
} 