<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_divisi_seeder = [
            [
                'id' => 1,
                'kode_divisi' => 'DIV-ADMIN', 
                'nama_divisi' => 'SUPER ADMIN', 
                'keterangan_divisi' => 'Divisi Super Admin',
                'is_active' => true, 
                'created_at' => now(), 
                'updated_at' => now(),
            ],
        ];

        foreach ($data_divisi_seeder as $data_input) {
            Divisi::create($data_input);
        }
    }
}
