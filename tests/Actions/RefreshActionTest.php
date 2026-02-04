<?php

use AymanAlhattami\FilamentContextMenu\Actions\RefreshAction;

test('RefreshAction is set up correctly', function () {
    $action = RefreshAction::make();

    expect($action->getName())->toBe('refresh')
        ->and($action->getLabel())->toBe('Refresh')
        ->and($action->getColor())->toBeNull()
        ->and($action->getIcon())->toBe('heroicon-o-arrow-path')
        ->and($action->isLink())->toBeFalse()
        ->and($action->getExtraAttributes())->toBeEmpty();
});
