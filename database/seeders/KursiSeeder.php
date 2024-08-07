<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KursiSeeder extends Seeder
{
    public function run()
    {
        $seats = [
            ['kursi' => 'A1'],
            ['kursi' => 'B2'],
            ['kursi' => 'CA'],
            ['kursi' => 'C4'],
            ['kursi' => 'D5'],
            ['kursi' => 'E6'],
            ['kursi' => 'F8'],
            ['kursi' => 'G9'],
            ['kursi' => 'H10'],
            ['kursi' => 'J11']
        ];

        foreach ($seats as $seat) {
            DB::table('kursi')->insert($seat);
        }
    }
}
