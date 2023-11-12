<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\Admin\AdminService;

class AdminSeeder extends Seeder
{
    protected AdminService $service;
    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "name" => "最高管理員",
            "account" => "admin",
            "password" => "123456",
            "phone" => "0987654321",
            "email" => "admin@gmail.com",
            "verify_id" => 1,
            "status" => 1,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        ];

        $this->service->add($data);
    }
}
