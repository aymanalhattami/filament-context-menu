<?php

namespace AymanAlhattami\FilamentContextMenu\Columns;

use AymanAlhattami\FilamentContextMenu\Traits\ColumnHasContextMenu;
use Filament\Tables\Columns\ToggleColumn;

class ContextMenuToggleColumn extends ToggleColumn
{
    use ColumnHasContextMenu;
}
