<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('studio')->insert([
            [
                'studio' => 'Studio 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'studio' => 'Studio 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data studio lainnya jika diperlukan
        ]);
    }
}
