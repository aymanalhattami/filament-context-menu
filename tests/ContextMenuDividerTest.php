<?php

use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;

test('ContextMenuDivider is set up correctly', function () {
    $divider = ContextMenuDivider::make();

    expect($divider->getName())->toBe('divider');

    expect($divider->getView())->toBe('filament-context-menu::components.divider');
});
