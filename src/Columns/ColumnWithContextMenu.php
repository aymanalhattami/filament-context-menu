<?php

namespace AymanAlhattami\FilamentContextMenu\Columns;

use Filament\Tables\Columns\TextColumn;

class ColumnWithContextMenu extends TextColumn
{
    protected string $view = 'filament-context-menu::filament.tables.columns.column-with-context-menu';
}
