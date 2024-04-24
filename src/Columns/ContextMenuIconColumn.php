<?php

namespace AymanAlhattami\FilamentContextMenu\Columns;

use AymanAlhattami\FilamentContextMenu\Traits\ColumnHasContextMenu;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class ContextMenuIconColumn extends IconColumn
{
    use ColumnHasContextMenu;
}
