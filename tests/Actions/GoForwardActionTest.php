<?php

use AymanAlhattami\FilamentContextMenu\Actions\GoForwardAction;

test('GoForwardAction is set up correctly', function () {
    $action = GoForwardAction::make();

    expect($action->getName())->toBe('go forward')
        ->and($action->getLabel())->toBe('Go forward')
        ->and($action->getColor())->toBe('gray')
        ->and($action->getIcon())->toBe('heroicon-o-arrow-right')
        ->and($action->isLink())->toBeTrue()
        ->and($action->getExtraAttributes())->toMatchArray([
            'x-data' => '',
            'x-on:click' => 'window.history.forward()',
        ]);
});
