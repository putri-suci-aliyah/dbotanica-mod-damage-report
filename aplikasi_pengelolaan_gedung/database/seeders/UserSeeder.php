<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_user_seeder = [
            [
                'name' => 'Admin Aplikasi', 
                'email' => 'admin_aplikasi@example.com', 
                'password' => Hash::make('123'), 
                'divisi_id' => 1, 
                'is_super_admin' => true, 
                'is_create' => true, 
                'is_delete' => true, 
                'is_update' => true, 
                'is_read' => true, 
                'is_active' => true,
                'created_at' => now(), 
                'updated_at' => now(),
            ],
        ];

        foreach ($data_user_seeder as $data_input) {
            User::create($data_input);
        }
    }
}
