<?php

namespace AymanAlhattami\FilamentContextMenu\Actions;

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
            ->icon('heroicon-o-arrow-left')
            ->link()
            ->extraAttributes([
                'x-data' => '',
                'x-on:click' => 'window.history.back()',
            ]);
    }
}
