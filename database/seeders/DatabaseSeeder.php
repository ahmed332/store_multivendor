<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Database\Factories\storeFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         Admin::factory(10)->create();
    Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin1@admin.com',
            'username' => 'admin',
            'password' => Hash::make('12345678'),
            'phone_number' => '01000000000',
            'super_admin' => true,
        ]);
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
         Store::factory(5)->create();

         Category::factory(15)->create();
        Product::factory(90)->create();
         $this->call(UserSeeder::class);
    }
}
