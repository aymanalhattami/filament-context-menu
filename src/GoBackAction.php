<?php

namespace AymanAlhattami\FilamentContextMenu;

use Filament\Actions\Action;

class GoBackAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'go back';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Go back')
            ->translateLabel()
            ->color('gray')
            ->url(url()->previous());
    }
}
