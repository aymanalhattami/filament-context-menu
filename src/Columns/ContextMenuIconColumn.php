<?php

namespace AymanAlhattami\FilamentContextMenu\Columns;

use AymanAlhattami\FilamentContextMenu\Traits\ColumnHasContextMenu;
use Filament\Tables\Columns\IconColumn;

class ContextMenuIconColumn extends IconColumn
{
    use ColumnHasContextMenu;
}
