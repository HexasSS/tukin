<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\DataPokok;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DataPokokImportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv',
        ]);

        // Store the file and get its path
        $filePath = $request->file('file')->store('uploads');

        // Import the file
        $this->importFile(storage_path('app/' . $filePath));

        return redirect()->route('/admin/data-pokoks')->with('success', 'File imported successfully!');
    }


    public function importFile($filePath)
    {
        // dd($filePath);
        // Define the field mapping between Excel and database
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

        try {
            (new FastExcel)->import($filePath, function ($line) use ($fieldMapping) {
                // Map Excel fields to database fields
                $mappedRow = [];
                foreach ($fieldMapping as $excelField => $dbField) {
                    $mappedRow[$dbField] = !empty($line[$excelField]) ? $line[$excelField] : null;
                }

                // Log raw data for debugging
                Log::info('Raw Row Data:', $mappedRow);

                $parseDate = function ($date) {
                    // Check if the date is already a DateTimeImmutable or similar
                    if ($date instanceof \DateTimeImmutable || $date instanceof \DateTime) {
                        return $date; // Return it as is
                    }

                    // Parse string dates
                    return !empty($date) ? Carbon::createFromFormat('d/m/Y H:i:s', str_replace(',000', '', $date)) : null;
                };

                // Handle datetime fields and other data
                $mappedRow['TMTPenyesuaian'] = $parseDate($mappedRow['TMTPenyesuaian']);
                $mappedRow['TMTTNI'] = $parseDate($mappedRow['TMTTNI']);
                $mappedRow['TanggalLahir'] = $parseDate($mappedRow['TanggalLahir']);
                $mappedRow['TMTJabatan'] = $parseDate($mappedRow['TMTJabatan']);
                $mappedRow['TanggalBuat'] = $parseDate($mappedRow['TanggalBuat']);
                $mappedRow['TanggalEdit'] = $parseDate($mappedRow['TanggalEdit']);
                // Insert or update the record
                DataPokok::updateOrCreate(['NRP' => $mappedRow['NRP']], $mappedRow);
            });
        } catch (\Exception $e) {
            Log::error('Import failed: ' . $e->getMessage());
            // Optionally, throw an exception or return a response indicating failure
        }
    }
}
