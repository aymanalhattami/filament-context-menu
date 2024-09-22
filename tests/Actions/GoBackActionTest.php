<?php

use AymanAlhattami\FilamentContextMenu\Actions\GoBackAction;

test('GoBackAction is set up correctly', function () {
    $action = GoBackAction::make();
    expect($action->getName())->toBe('go back')
        ->and($action->getLabel())->toBe('Go back')
        ->and($action->getColor())->toBe('gray')
        ->and($action->getIcon())->toBe('heroicon-o-arrow-left')
        ->and($action->isLink())->toBeTrue()
        ->and($action->getExtraAttributes())->toMatchArray([
            'x-data' => '',
            'x-on:click' => 'window.history.back()',
        ]);
});
