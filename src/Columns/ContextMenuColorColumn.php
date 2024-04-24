<?php

namespace AymanAlhattami\FilamentContextMenu\Columns;

use AymanAlhattami\FilamentContextMenu\Traits\ColumnHasContextMenu;
use Filament\Tables\Columns\ColorColumn;

class ContextMenuColorColumn extends ColorColumn
{
    use ColumnHasContextMenu;
}
