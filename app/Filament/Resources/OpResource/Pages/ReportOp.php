<?php

namespace App\Filament\Resources\OpResource\Pages;

use App\Filament\Resources\OpResource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;

class ReportOp extends Page
{
    protected static string $resource = OpResource::class;

    protected static string $view = 'filament.resources.op-resource.pages.report-op';

    protected static ?string $title = 'Relatório';


}
