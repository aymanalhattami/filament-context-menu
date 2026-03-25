<?php

use AymanAlhattami\FilamentContextMenu\Actions\GoBackAction;

test('GoBackAction is set up correctly', function () {
    $action = GoBackAction::make();
    expect($action->getName())->toBe('go back')
        ->and($action->getLabel())->toBe('Go Back')
        ->and($action->getColor())->toBeNull()
        ->and($action->getIcon())->toBe('heroicon-o-arrow-left')
        ->and($action->isLink())->toBeFalse()
        ->and($action->getExtraAttributes())->toBeEmpty();
});
