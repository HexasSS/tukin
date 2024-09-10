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
            ['sat_juru_bayar' => '347306', 'nama_sat_juru_bayar' => 'SATHANLAN LANUD IWJ', 'pekas' => '404', 'satker' => '0404', 'anak_satker' => '21', 'kd_satker' => '344837'],
            ['sat_juru_bayar' => '347307', 'nama_sat_juru_bayar' => 'DISPOTDIRGA LANUD IWJ', 'pekas' => '404', 'satker' => '0404', 'anak_satker' => '22', 'kd_satker' => '344837'],
            ['sat_juru_bayar' => '070900', 'nama_sat_juru_bayar' => 'LANUD IGNATIUS DEWANTO', 'pekas' => '709', 'satker' => '0709', 'anak_satker' => '01', 'kd_satker' => '686008'],
            ['sat_juru_bayar' => '064700', 'nama_sat_juru_bayar' => 'SKOMLEKAU', 'pekas' => '647', 'satker' => '0647', 'anak_satker' => '00', 'kd_satker' => '686003'],
            ['sat_juru_bayar' => '255000', 'nama_sat_juru_bayar' => 'WINGDIK 100/ADI', 'pekas' => '405', 'satker' => '0502', 'anak_satker' => '01', 'kd_satker' => '344858'],
        ];


        DB::table('juru_bayars')->insert($data);
    }
}
