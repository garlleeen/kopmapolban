<?php

namespace App\Jobs;

use Faker\Factory;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Hash;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class DataUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {        
        $faker = Factory::create();
        $jumlahData = 5;
        for ($i = 1; $i <= $jumlahData; $i++){
            $data = [
            'fullname' => $faker->name(),
            'email' => $faker->unique()->email(),
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('1234567890'),
            'remember_token' => Str::random(10),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ];
            User::Create($data);
        }
    }
}
