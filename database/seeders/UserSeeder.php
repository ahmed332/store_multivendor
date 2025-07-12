<?php

namespace Database\Seeders;

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
            // Create admin user
            User::create([
                'name' => 'Admin',
                'email' => 'ahmed_monsef@gmail.com',
                'password' => Hash::make('12345678')
            ]);

            // Create regular user
            User::create([
                'name' => 'Ahmed',
                'email' => 'ahmed@gmail.com',
                'password' => Hash::make('12345678')
            ]);
            DB::table("users")->insert([
                 'name' => 'Ahmed9',
                'email' => 'ahmed9@gmail.com',
                'password' => Hash::make('123456789')
            ]);

            $this->command->info('Users seeded successfully!');
        } catch (\Exception $e) {
            Log::error('Error seeding users: ' . $e->getMessage());
            $this->command->error('Error seeding users: ' . $e->getMessage());
        }
    }
}
