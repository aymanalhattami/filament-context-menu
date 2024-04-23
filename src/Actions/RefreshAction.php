<?php

namespace AymanAlhattami\FilamentContextMenu\Actions;

use Filament\Actions\Action;

class RefreshAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'refresh';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Refresh')
            ->translateLabel()
            ->color('gray')
            ->icon('heroicon-o-arrow-path')
            ->link()
            ->extraAttributes([
                'x-data' => '',
                'x-on:click' => 'window.location.reload()',
            ]);
    }
}
