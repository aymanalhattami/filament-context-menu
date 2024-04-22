<?php

namespace AymanAlhattami\FilamentContextMenu\Actions;

use Filament\Actions\Action;

class GoForwardAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'go forward';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Go forward')
            ->translateLabel()
            ->color('gray')
            ->icon('heroicon-o-arrow-right')
            ->link()
            ->extraAttributes([
                'x-data' => '',
                'x-on:click' => 'window.history.forward()',
            ]);
    }
}
