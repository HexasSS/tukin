<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JuruBayarsTableSeeder extends Seeder
{
    /**
     * Seed the juru_bayars table.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['SatJuruBayar' => 347306, 'NamaSatJuruBayar' => 'SATHANLAN LANUD IWJ', 'Pekas' => '404', 'SatKer' => '0404', 'AnakSatker' => '21', 'KdSatker' => '344837'],
            ['SatJuruBayar' => 347307, 'NamaSatJuruBayar' => 'DISPOTDIRGA LANUD IWJ', 'Pekas' => '404', 'SatKer' => '0404', 'AnakSatker' => '22', 'KdSatker' => '344837'],
            ['SatJuruBayar' => 070900, 'NamaSatJuruBayar' => 'LANUD IGNATIUS DEWANTO', 'Pekas' => '709', 'SatKer' => '0709', 'AnakSatker' => '01', 'KdSatker' => '686008'],
            ['SatJuruBayar' => 064700, 'NamaSatJuruBayar' => 'SKOMLEKAU', 'Pekas' => '647', 'SatKer' => '0647', 'AnakSatker' => '00', 'KdSatker' => '686003'],
            // Add the rest of your data here
        ];

        DB::table('juru_bayars')->insert($data);
    }
}
