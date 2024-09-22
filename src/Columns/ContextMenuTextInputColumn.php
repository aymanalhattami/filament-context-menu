<?php

namespace AymanAlhattami\FilamentContextMenu\Columns;

use AymanAlhattami\FilamentContextMenu\Traits\ColumnHasContextMenu;
use Filament\Forms\Components\TextInput;

class ContextMenuTextInputColumn extends TextInput
{
    use ColumnHasContextMenu;
}
