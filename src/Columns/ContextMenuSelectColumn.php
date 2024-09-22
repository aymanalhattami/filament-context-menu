<?php

namespace AymanAlhattami\FilamentContextMenu\Columns;

use AymanAlhattami\FilamentContextMenu\Traits\ColumnHasContextMenu;
use Filament\Tables\Columns\SelectColumn;

class ContextMenuSelectColumn extends SelectColumn
{
    use ColumnHasContextMenu;
}
