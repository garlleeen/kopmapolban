<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $AdministratorRole = User::create([
            'fullname' => 'Koperasi Mahasiswa POLBAN',
            'email' => 'administrator@kopmapolban.com',
            'email_verified_at' => now(),
            'password' => Hash::make('mNw8ewpgZ+'),
            'remember_token' => Str::random(10),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $AdministratorRole->assignRole('Administrator');
    }
}
