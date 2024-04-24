<?php

namespace AymanAlhattami\FilamentContextMenu\Columns;

use AymanAlhattami\FilamentContextMenu\Traits\ColumnHasContextMenu;
use Filament\Tables\Columns\ImageColumn;

class ContextMenuImageColumn extends ImageColumn
{
    use ColumnHasContextMenu;
}
