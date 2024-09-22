<?php

use AymanAlhattami\FilamentContextMenu\Actions\CopyAction;

test('CopyAction is set up correctly', function () {
    $action = CopyAction::make();
    expect($action->getName())->toBe('copy')
        ->and($action->getLabel())->toBe('Copy')
        ->and($action->getColor())->toBe('gray')
        ->and($action->getIcon())->toBe('heroicon-o-clipboard-document')
        ->and($action->isLink())->toBeTrue()
        ->and($action->getExtraAttributes())->toBeEmpty();
});
