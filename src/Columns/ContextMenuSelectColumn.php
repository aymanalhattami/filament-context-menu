<?php

namespace AymanAlhattami\FilamentContextMenu\Columns;

use AymanAlhattami\FilamentContextMenu\Traits\ColumnHasContextMenu;
use Filament\Tables\Columns\ColorColumn;

class ContextMenuSelectColumn extends ColorColumn
{
    use ColumnHasContextMenu;
}
