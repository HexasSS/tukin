<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPokoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pokoks', function (Blueprint $table) {
            $table->string('NRP')->unique();
            $table->string('Nama')->nullable();
            $table->integer('Pangkat')->nullable();
            $table->string('PangkatTituler')->nullable();
            $table->integer('KelompokDPP')->nullable();
            $table->integer('AsalMasukan')->nullable();
            $table->dateTime('TMTTNI')->nullable();
            $table->dateTime('TMTPenyesuaian')->nullable();
            $table->string('SatJuruBayar')->nullable();
            $table->dateTime('TanggalLahir')->nullable();
            $table->integer('JenisKelamin')->nullable();
            $table->integer('StatusKawin')->nullable();
            $table->integer('JumlahAnak')->nullable();
            $table->integer('JumlahTanggungan')->nullable();
            $table->integer('StatPenghasilan')->nullable();
            $table->integer('Korps')->nullable();
            $table->integer('UnitOrganisasi')->nullable();
            $table->integer('Kotama')->nullable();
            $table->integer('StatJabatan')->nullable();
            $table->integer('JenisJabatan')->nullable();
            $table->integer('EselonJabatan')->nullable();
            $table->integer('JnsJab2')->nullable();
            $table->integer('EseJab2')->nullable();
            $table->string('NamaJabatan')->nullable();
            $table->dateTime('TMTJabatan')->nullable();
            $table->integer('Skorsing')->nullable();
            $table->integer('Kotji')->nullable();
            $table->integer('GantiRugi')->nullable();
            $table->integer('SewaRumah')->nullable();
            $table->integer('TunPeralihan')->nullable();
            $table->integer('BulanWarakawuri')->nullable();
            $table->string('SatOrganik')->nullable();
            $table->string('Pekas')->nullable();
            $table->string('Satker')->nullable();
            $table->dateTime('TanggalBuat')->nullable();
            $table->dateTime('TanggalEdit')->nullable();
            $table->string('BuatOleh')->nullable();
            $table->string('EditOleh')->nullable();
            $table->integer('BulanKumulatif')->nullable();
            $table->integer('TotalBulan')->nullable();
            $table->integer('Gapok_KL')->nullable();
            $table->integer('Gapok_K')->nullable();
            $table->integer('TunKeluarga_KL')->nullable();
            $table->integer('TunKeluarga_K')->nullable();
            $table->integer('TunKhusus_KL')->nullable();
            $table->integer('TunKhusus_K')->nullable();
            $table->integer('TunLain_KL')->nullable();
            $table->integer('TunLain_K')->nullable();
            $table->integer('SilBruto_KL')->nullable();
            $table->integer('SilBruto_K')->nullable();
            $table->integer('PenBruto_KL')->nullable();
            $table->integer('PenBruto_K')->nullable();
            $table->integer('BJab_KL')->nullable();
            $table->integer('BJab_K')->nullable();
            $table->integer('Ipen_KL')->nullable();
            $table->integer('Ipen_K')->nullable();
            $table->integer('PTKP_KL')->nullable();
            $table->integer('PTKP_K')->nullable();
            $table->integer('PKP_KL')->nullable();
            $table->integer('PKP_K')->nullable();
            $table->integer('PPHTerhutang_KL')->nullable();
            $table->integer('PPHTerhutang_K')->nullable();
            $table->integer('PPHSetor_KL')->nullable();
            $table->integer('PPHSetor_K')->nullable();
            $table->integer('SilTakTeratur_KL')->nullable();
            $table->integer('SilTakTeratur_K')->nullable();
            $table->integer('PPHTakTeratur_KL')->nullable();
            $table->integer('PPHTakTeratur_K')->nullable();
            $table->integer('StIrja')->nullable();
            $table->string('GapokLama')->nullable();
            $table->integer('Kd_pkt_gol')->nullable();
            $table->string('Gapok')->nullable();
            $table->integer('TGrade')->nullable();
            $table->integer('Tperbatasan')->nullable();
            $table->integer('TWP')->nullable();
            $table->string('KdSatker')->nullable();
            $table->string('KdAnakSatker')->nullable();
            $table->string('MKG')->nullable();
            $table->string('NPWP')->nullable();
            $table->string('NAMA_REK')->nullable();
            $table->string('NAMA_BANK')->nullable();
            $table->string('NO_REK')->nullable();
            $table->string('SANDI')->nullable();
            $table->string('KD_BANK_SPAN')->nullable();
            $table->string('KD_SWIFT')->nullable();
            $table->string('KD_POS')->nullable();
            $table->string('KD_NEGARA')->nullable();
            $table->string('KD_KPPN')->nullable();
            $table->string('TIPE_SUP')->nullable();
            $table->string('KOTA')->nullable();
            $table->string('PROV')->nullable();
            $table->string('EMAIL')->nullable();
            $table->string('TELEPON')->nullable();
            $table->string('KD_IBAN')->nullable();
            $table->string('ALAMAT')->nullable();
            $table->string('KD_NAB')->nullable();
            $table->string('KD_LOKASI')->nullable();
            $table->string('KD_KABKOTA')->nullable();
            $table->string('NRS')->nullable();
            $table->string('KDJAB')->nullable();
            $table->string('NRP_FULL')->nullable();
            $table->string('TEMPATLHR')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_pokoks');
    }
}
