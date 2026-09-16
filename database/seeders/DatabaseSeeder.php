<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id' => Str::uuid(),
            'name' => env('ADMIN_NAME', 'Admin'),
            'email' => env('ADMIN_EMAIL', 'admin@eduenroll.com'),
            'password' => bcrypt(env('ADMIN_PASSWORD', 'password')),
            'is_admin' => true,
            'class_id' => null,
        ]);
    }
}