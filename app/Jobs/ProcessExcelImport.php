<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\DataPokok;
use Carbon\Carbon;

class ProcessExcelImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $userId;

    /**
     * Create a new job instance.
     *
     * @param  string  $filePath
     * @param  int  $userId
     * @return void
     */
    public function __construct($filePath, $userId)
    {
        $this->filePath = $filePath;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fieldMapping = [
            'NRP' => 'NRP',
            'Nama' => 'Nama',
            'Pangkat' => 'Pangkat',
            'PangkatTituler' => 'PangkatTituler',
            'KelompokDPP' => 'KelompokDPP',
            'AsalMasukan' => 'AsalMasukan',
            'TMTTNI' => 'TMTTNI',
            'TMTPenyesuaian' => 'TMTPenyesuaian',
            'SatJuruBayar' => 'SatJuruBayar',
            'TanggalLahir' => 'TanggalLahir',
            'JenisKelamin' => 'JenisKelamin',
            'StatusKawin' => 'StatusKawin',
            'JumlahAnak' => 'JumlahAnak',
            'JumlahTanggungan' => 'JumlahTanggungan',
            'StatPenghasilan' => 'StatPenghasilan',
            'Korps' => 'Korps',
            'UnitOrganisasi' => 'UnitOrganisasi',
            'Kotama' => 'Kotama',
            'StatJabatan' => 'StatJabatan',
            'JenisJabatan' => 'JenisJabatan',
            'EselonJabatan' => 'EselonJabatan',
            'JnsJab2' => 'JnsJab2',
            'EseJab2' => 'EseJab2',
            'NamaJabatan' => 'NamaJabatan',
            'TMTJabatan' => 'TMTJabatan',
            'Skorsing' => 'Skorsing',
            'Kotji' => 'Kotji',
            'GantiRugi' => 'GantiRugi',
            'SewaRumah' => 'SewaRumah',
            'TunPeralihan' => 'TunPeralihan',
            'BulanWarakawuri' => 'BulanWarakawuri',
            'SatOrganik' => 'SatOrganik',
            'Pekas' => 'Pekas',
            'Satker' => 'Satker',
            'TanggalBuat' => 'TanggalBuat',
            'TanggalEdit' => 'TanggalEdit',
            'BuatOleh' => 'BuatOleh',
            'EditOleh' => 'EditOleh',
            'BulanKumulatif' => 'BulanKumulatif',
            'TotalBulan' => 'TotalBulan',
            'Gapok_KL' => 'Gapok_KL',
            'Gapok_K' => 'Gapok_K',
            'TunKeluarga_KL' => 'TunKeluarga_KL',
            'TunKeluarga_K' => 'TunKeluarga_K',
            'TunKhusus_KL' => 'TunKhusus_KL',
            'TunKhusus_K' => 'TunKhusus_K',
            'TunLain_KL' => 'TunLain_KL',
            'TunLain_K' => 'TunLain_K',
            'SilBruto_KL' => 'SilBruto_KL',
            'SilBruto_K' => 'SilBruto_K',
            'PenBruto_KL' => 'PenBruto_KL',
            'PenBruto_K' => 'PenBruto_K',
            'BJab_KL' => 'BJab_KL',
            'BJab_K' => 'BJab_K',
            'Ipen_KL' => 'Ipen_KL',
            'Ipen_K' => 'Ipen_K',
            'PTKP_KL' => 'PTKP_KL',
            'PTKP_K' => 'PTKP_K',
            'PKP_KL' => 'PKP_KL',
            'PKP_K' => 'PKP_K',
            'PPHTerhutang_KL' => 'PPHTerhutang_KL',
            'PPHTerhutang_K' => 'PPHTerhutang_K',
            'PPHSetor_KL' => 'PPHSetor_KL',
            'PPHSetor_K' => 'PPHSetor_K',
            'SilTakTeratur_KL' => 'SilTakTeratur_KL',
            'SilTakTeratur_K' => 'SilTakTeratur_K',
            'PPHTakTeratur_KL' => 'PPHTakTeratur_KL',
            'PPHTakTeratur_K' => 'PPHTakTeratur_K',
            'StIrja' => 'StIrja',
            'GapokLama' => 'GapokLama',
            'Kd_pkt_gol' => 'Kd_pkt_gol',
            'Gapok' => 'Gapok',
            'TGrade' => 'TGrade',
            'Tperbatasan' => 'Tperbatasan',
            'TWP' => 'TWP',
            'KdSatker' => 'KdSatker',
            'KdAnakSatker' => 'KdAnakSatker',
            'MKG' => 'MKG',
            'NPWP' => 'NPWP',
            'NAMA_REK' => 'NAMA_REK',
            'NAMA_BANK' => 'NAMA_BANK',
            'NO_REK' => 'NO_REK',
            'SANDI' => 'SANDI',
            'KD_BANK_SPAN' => 'KD_BANK_SPAN',
            'KD_SWIFT' => 'KD_SWIFT',
            'KD_POS' => 'KD_POS',
            'KD_NEGARA' => 'KD_NEGARA',
            'KD_KPPN' => 'KD_KPPN',
            'TIPE_SUP' => 'TIPE_SUP',
            'KOTA' => 'KOTA',
            'PROV' => 'PROV',
            'EMAIL' => 'EMAIL',
            'TELEPON' => 'TELEPON',
            'KD_IBAN' => 'KD_IBAN',
            'ALAMAT' => 'ALAMAT',
            'KD_NAB' => 'KD_NAB',
            'KD_LOKASI' => 'KD_LOKASI',
            'KD_KABKOTA' => 'KD_KABKOTA',
            'NRS' => 'NRS',
            'KDJAB' => 'KDJAB',
            'NRP_FULL' => 'NRP_FULL',
            'TEMPATLHR' => 'TEMPATLHR',
        ];

        (new FastExcel)->import($this->filePath, function ($line) use ($fieldMapping) {
            // Map Excel fields to database fields
            $mappedRow = [];
            foreach ($fieldMapping as $excelField => $dbField) {
                $mappedRow[$dbField] = !empty($line[$excelField]) ? $line[$excelField] : null;
            }

            // Handle datetime fields and other data
            $mappedRow['TMTPenyesuaian'] = !empty($mappedRow['TMTPenyesuaian']) ? Carbon::parse($mappedRow['TMTPenyesuaian']) : null;
            $mappedRow['TMTTNI'] = !empty($mappedRow['TMTTNI']) ? Carbon::parse($mappedRow['TMTTNI']) : null;
            $mappedRow['TanggalLahir'] = !empty($mappedRow['TanggalLahir']) ? Carbon::parse($mappedRow['TanggalLahir']) : null;
            $mappedRow['TMTJabatan'] = !empty($mappedRow['TMTJabatan']) ? Carbon::parse($mappedRow['TMTJabatan']) : null;
            $mappedRow['TanggalBuat'] = !empty($mappedRow['TanggalBuat']) ? Carbon::parse($mappedRow['TanggalBuat']) : null;
            $mappedRow['TanggalEdit'] = !empty($mappedRow['TanggalEdit']) ? Carbon::parse($mappedRow['TanggalEdit']) : null;

            // Insert or update the record in the database
            DataPokok::updateOrCreate(
                ['NRP' => $mappedRow['NRP']], // Example unique field
                $mappedRow
            );
        });
    }
}
