<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => "陌生客",
                "account" => "user001",
                "password" => "123456",
                "email" => "user001@gmail.com",
                "refcode" => "88888888",
                "phone" => "0987654321",
                "status" => 1,
                "gender" => "1",
                "birth" => Carbon::now(),
                "level_id" => 1,
                "address" => "address",
            ],
        ];

        User::insert($data);
    }
}
