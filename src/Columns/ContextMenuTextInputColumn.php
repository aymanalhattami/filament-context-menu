<?php

namespace AymanAlhattami\FilamentContextMenu\Columns;

use AymanAlhattami\FilamentContextMenu\Traits\ColumnHasContextMenu;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColorColumn;

class ContextMenuTextInputColumn extends TextInput
{
    use ColumnHasContextMenu;
}
