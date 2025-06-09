<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use App\Models\Pendaftaran;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::create([
            'name' => 'fardian',
            'email' => 'fardianzahri24@gmail.com',
            'password' => bcrypt('kpunpam1234fardian'), // Password admin
            'role' => 'petugas',
            "is_verified"=>1,
        ]);

        User::factory(30)->create()->each(function ($user) {
            $user->pendaftaran()->save(Pendaftaran::factory()->make([
                'user_id' => $user->id,
            ]));
        });
    }
}
