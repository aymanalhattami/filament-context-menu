<?php

use AymanAlhattami\FilamentContextMenu\Actions\GoBackAction;
use AymanAlhattami\FilamentContextMenu\Actions\GoForwardAction;
use AymanAlhattami\FilamentContextMenu\Columns\ContextMenuTextColumn;
use Illuminate\Support\Facades\Config;

test('ColumnHasContextMenu is set up correctly', function () {
    // Create a column instance using the ColumnHasContextMenu trait
    $column = ContextMenuTextColumn::make('name');

    // Test default view
    expect($column->getView())->toBe('filament-context-menu::filament.tables.columns.context-menu-column');

    // Test setting and getting the view
    $column->view('my-main-view');
    expect($column->getView())->toBe('my-main-view');

    // Test context menu actions
    $column->contextMenuActions([GoBackAction::make(), GoForwardAction::make()]);
    expect($column->getContextMenuActions())->toHaveCount(2)
        ->and($column->getContextMenuActions()[0])->toBeInstanceOf(GoBackAction::class)
        ->and($column->getContextMenuActions()[1])->toBeInstanceOf(GoForwardAction::class);

    // Test enabling/disabling the context menu
    $column->enableContextMenu(false);
    expect($column->isContextMenuEnabled())->toBeFalse();

    // Test enabling the context menu with actions
    $column->enableContextMenu(true);
    Config::set('filament-context-menu.enabled', true); // Ensure config is enabled
    expect($column->isContextMenuEnabled())->toBeTrue();

    // Test view customization
    $column->view('custom-view');
    expect($column->getView())->toBe('custom-view');
});
