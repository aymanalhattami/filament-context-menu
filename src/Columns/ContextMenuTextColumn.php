<?php

namespace AymanAlhattami\FilamentContextMenu\Columns;

use AymanAlhattami\FilamentContextMenu\Traits\ColumnHasContextMenu;
use Filament\Tables\Columns\TextColumn;

class ContextMenuTextColumn extends TextColumn
{
    use ColumnHasContextMenu;
}
