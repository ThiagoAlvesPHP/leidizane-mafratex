<?php

namespace App\Filament\Resources\OpResource\Pages;

use App\Filament\Resources\OpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOps extends ListRecords
{
    protected static string $resource = OpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('report')
                ->label('Relatório')
                ->color('success')
                ->url(ReportOp::getUrl()),
        ];
    }
}
