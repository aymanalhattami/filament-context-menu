<?php

namespace AymanAlhattami\FilamentContextMenu\Columns;

use AymanAlhattami\FilamentContextMenu\Traits\ColumnHasContextMenu;
use Filament\Tables\Columns\CheckboxColumn;

class ContextMenuCheckboxColumn extends CheckboxColumn
{
    use ColumnHasContextMenu;
}
