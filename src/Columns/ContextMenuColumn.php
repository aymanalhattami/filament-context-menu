<?php

namespace AymanAlhattami\FilamentContextMenu\Columns;

use Filament\Tables\Columns\TextColumn;

class ContextMenuColumn extends TextColumn
{
    use \AymanAlhattami\FilamentContextMenu\Traits\ColumnWithContextMenu;

    /**
     * @throws \Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->mainView($this->getView())
            ->view($this->getWrapperView());
    }
}
