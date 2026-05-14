<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {

            Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => Hash::make('12345678'),
            'phone_number' => '01000000000',
            'super_admin' => true,
        ]);
           

            $this->command->info('Users seeded successfully!');
        } catch (\Exception $e) {
            Log::error('Error seeding users: ' . $e->getMessage());
            $this->command->error('Error seeding users: ' . $e->getMessage());
        }
    }
}
