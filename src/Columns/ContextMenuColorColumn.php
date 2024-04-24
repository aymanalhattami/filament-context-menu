<?php

namespace AymanAlhattami\FilamentContextMenu\Columns;

use AymanAlhattami\FilamentContextMenu\Traits\ColumnHasContextMenu;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;

class ContextMenuColorColumn extends ColorColumn
{
    use ColumnHasContextMenu;
}
