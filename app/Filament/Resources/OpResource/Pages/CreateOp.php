<?php

namespace App\Filament\Resources\OpResource\Pages;

use App\Filament\Resources\OpResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOp extends CreateRecord
{
    protected static string $resource = OpResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
