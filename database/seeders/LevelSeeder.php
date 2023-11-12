<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
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
                "name" => "青銅等級",
                "rank" => 1,
            ],
            [
                "name" => "白銀等級",
                "rank" => 2,
            ],
            [
                "name" => "黃金等級",
                "rank" => 3,
            ],
            [
                "name" => "白金等級",
                "rank" => 4,
            ],
            [
                "name" => "鑽石等級",
                "rank" => 5,
            ],
        ];

        Level::insert($data);
    }
}
