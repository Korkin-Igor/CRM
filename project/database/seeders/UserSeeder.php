<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use function Brotli\compress;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Igor',
            'email' => 'igor@mail.com',
            'password' => '12345678',
        ]);
        User::factory(5)->create();
    }
}
