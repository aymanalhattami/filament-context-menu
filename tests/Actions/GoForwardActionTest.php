<?php

use AymanAlhattami\FilamentContextMenu\Actions\GoForwardAction;

test('GoForwardAction is set up correctly', function () {
    $action = GoForwardAction::make();

    expect($action->getName())->toBe('go forward')
        ->and($action->getLabel())->toBe('Go Forward')
        ->and($action->getColor())->toBeNull()
        ->and($action->getIcon())->toBe('heroicon-o-arrow-right')
        ->and($action->isLink())->toBeFalse()
        ->and($action->getExtraAttributes())->toBeEmpty();
});
