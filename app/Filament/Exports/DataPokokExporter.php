<?php

namespace App\Filament\Exports;

use App\Models\DataPokok;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class DataPokokExporter extends Exporter
{
    protected static ?string $model = DataPokok::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('NRP'),
            ExportColumn::make('Nama'),
            ExportColumn::make('Pangkat'),
            ExportColumn::make('PangkatTituler'),
            ExportColumn::make('KelompokDPP'),
            ExportColumn::make('AsalMasukan'),
            ExportColumn::make('TMTTNI'),
            ExportColumn::make('TMTPenyesuaian'),
            ExportColumn::make('SatJuruBayar'),
            ExportColumn::make('TanggalLahir'),
            ExportColumn::make('JenisKelamin'),
            ExportColumn::make('StatusKawin'),
            ExportColumn::make('JumlahAnak'),
            ExportColumn::make('JumlahTanggungan'),
            ExportColumn::make('StatPenghasilan'),
            ExportColumn::make('Korps'),
            ExportColumn::make('UnitOrganisasi'),
            ExportColumn::make('Kotama'),
            ExportColumn::make('StatJabatan'),
            ExportColumn::make('JenisJabatan'),
            ExportColumn::make('EselonJabatan'),
            ExportColumn::make('JnsJab2'),
            ExportColumn::make('EseJab2'),
            ExportColumn::make('NamaJabatan'),
            ExportColumn::make('TMTJabatan'),
            ExportColumn::make('Skorsing'),
            ExportColumn::make('Kotji'),
            ExportColumn::make('GantiRugi'),
            ExportColumn::make('SewaRumah'),
            ExportColumn::make('TunPeralihan'),
            ExportColumn::make('BulanWarakawuri'),
            ExportColumn::make('SatOrganik'),
            ExportColumn::make('Pekas'),
            ExportColumn::make('Satker'),
            ExportColumn::make('TanggalBuat'),
            ExportColumn::make('TanggalEdit'),
            ExportColumn::make('BuatOleh'),
            ExportColumn::make('EditOleh'),
            ExportColumn::make('BulanKumulatif'),
            ExportColumn::make('TotalBulan'),
            ExportColumn::make('Gapok_KL'),
            ExportColumn::make('Gapok_K'),
            ExportColumn::make('TunKeluarga_KL'),
            ExportColumn::make('TunKeluarga_K'),
            ExportColumn::make('TunKhusus_KL'),
            ExportColumn::make('TunKhusus_K'),
            ExportColumn::make('TunLain_KL'),
            ExportColumn::make('TunLain_K'),
            ExportColumn::make('SilBruto_KL'),
            ExportColumn::make('SilBruto_K'),
            ExportColumn::make('PenBruto_KL'),
            ExportColumn::make('PenBruto_K'),
            ExportColumn::make('BJab_KL'),
            ExportColumn::make('BJab_K'),
            ExportColumn::make('Ipen_KL'),
            ExportColumn::make('Ipen_K'),
            ExportColumn::make('PTKP_KL'),
            ExportColumn::make('PTKP_K'),
            ExportColumn::make('PKP_KL'),
            ExportColumn::make('PKP_K'),
            ExportColumn::make('PPHTerhutang_KL'),
            ExportColumn::make('PPHTerhutang_K'),
            ExportColumn::make('PPHSetor_KL'),
            ExportColumn::make('PPHSetor_K'),
            ExportColumn::make('SilTakTeratur_KL'),
            ExportColumn::make('SilTakTeratur_K'),
            ExportColumn::make('PPHTakTeratur_KL'),
            ExportColumn::make('PPHTakTeratur_K'),
            ExportColumn::make('StIrja'),
            ExportColumn::make('GapokLama'),
            ExportColumn::make('Kd_pkt_gol'),
            ExportColumn::make('Gapok'),
            ExportColumn::make('TGrade'),
            ExportColumn::make('Tperbatasan'),
            ExportColumn::make('TWP'),
            ExportColumn::make('KdSatker'),
            ExportColumn::make('KdAnakSatker'),
            ExportColumn::make('MKG'),
            ExportColumn::make('NPWP'),
            ExportColumn::make('NAMA_REK'),
            ExportColumn::make('NAMA_BANK'),
            ExportColumn::make('NO_REK'),
            ExportColumn::make('SANDI'),
            ExportColumn::make('KD_BANK_SPAN'),
            ExportColumn::make('KD_SWIFT'),
            ExportColumn::make('KD_POS'),
            ExportColumn::make('KD_NEGARA'),
            ExportColumn::make('KD_KPPN'),
            ExportColumn::make('TIPE_SUP'),
            ExportColumn::make('KOTA'),
            ExportColumn::make('PROV'),
            ExportColumn::make('EMAIL'),
            ExportColumn::make('TELEPON'),
            ExportColumn::make('KD_IBAN'),
            ExportColumn::make('ALAMAT'),
            ExportColumn::make('KD_NAB'),
            ExportColumn::make('KD_LOKASI'),
            ExportColumn::make('KD_KABKOTA'),
            ExportColumn::make('NRS'),
            ExportColumn::make('KDJAB'),
            ExportColumn::make('NRP_FULL'),
            ExportColumn::make('TEMPATLHR'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your data pokok export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
