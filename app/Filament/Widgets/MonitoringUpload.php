<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\JuruBayar;
use App\Models\DataPokok;

class MonitoringUpload extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                JuruBayar::query()
                    ->withCount([
                        'dataPokoks as TNI_count' => function ($query) {
                            $query->whereColumn('SatJuruBayar', 'juru_bayars.sat_juru_bayar')
                                ->where('KelompokDPP', 1);
                        },
                        'dataPokoks as PNS_count' => function ($query) {
                            $query->whereColumn('SatJuruBayar', 'juru_bayars.sat_juru_bayar')
                                ->where('KelompokDPP', 2);
                        },
                        'dataPokoks as CPNS_count' => function ($query) {
                            $query->whereColumn('SatJuruBayar', 'juru_bayars.sat_juru_bayar')
                                ->where('KelompokDPP', 3);
                        },
                        'dataPokoks as PPPK_count' => function ($query) {
                            $query->whereColumn('SatJuruBayar', 'juru_bayars.sat_juru_bayar')
                                ->where('KelompokDPP', 4);
                        }
                    ])
            )
            ->columns([
                TextColumn::make('nama_sat_juru_bayar')
                    ->label('Juru Bayar')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('TNI_count')
                    ->label('TNI')
                    ->sortable(),
                TextColumn::make('PNS_count')
                    ->label('PNS')
                    ->sortable(),
                TextColumn::make('CPNS_count')
                    ->label('CPNS')
                    ->sortable(),
                TextColumn::make('PPPK_count')
                    ->label('PPPK')
                    ->sortable(),
                TextColumn::make('total_count')
                    ->label('Total')
                    ->getStateUsing(function (JuruBayar $record) {
                        return $record->TNI_count + $record->PNS_count + $record->CPNS_count + $record->PPPK_count;
                    })
                    ->sortable(),
            ]);
    }
}
