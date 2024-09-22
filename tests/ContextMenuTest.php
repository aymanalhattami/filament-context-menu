<?php

use AymanAlhattami\FilamentContextMenu\ContextMenu;
use AymanAlhattami\FilamentContextMenu\Actions\GoBackAction;
use AymanAlhattami\FilamentContextMenu\Actions\GoForwardAction;

test('ContextMenu is set up correctly', function () {
    // Create a ContextMenu instance
    $contextMenu = ContextMenu::make();

    // Test title setting
    $contextMenu->title('My Context Menu');
    expect($contextMenu->getTitle())->toBe('My Context Menu');

    // Test title with translation
    $contextMenu->translateTitle(true);
    expect($contextMenu->isTitleTranslatable())->toBeTrue();

    // Test title translation (assuming the translation works)
    $contextMenu->title('menu.title');
    expect($contextMenu->getTitle())->toBe(__('menu.title'));

    // Test setting actions
    $contextMenu->actions([
        GoBackAction::make(),
        GoForwardAction::make(),
    ]);

    // Assert that the actions array contains the correct actions
    expect($contextMenu->getActions())->toHaveCount(2)
        ->and($contextMenu->getActions()[0])->toBeInstanceOf(GoBackAction::class)
        ->and($contextMenu->getActions()[1])->toBeInstanceOf(GoForwardAction::class);
});
