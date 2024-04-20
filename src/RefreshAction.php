<?php

namespace AymanAlhattami\FilamentContextMenu;

use Filament\Actions\Action;

class RefreshAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'go back';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Refresh')
            ->translateLabel()
            ->color('gray')
            ->url(request()->fullUrl())
            ->icon('heroicon-o-arrow-path')
            ->link();
    }
}
