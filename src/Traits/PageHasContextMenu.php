<?php

namespace AymanAlhattami\FilamentContextMenu\Traits;

use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use InvalidArgumentException;

trait PageHasContextMenu
{
    use InteractsWithActions;

    protected array $cachedContextMenuActions = [];

    public static bool $contextMenuEnabled = true;

    public static function isContextMenuEnabled(): bool
    {
        return static::$contextMenuEnabled and config('filament-context-menu.enabled', true);
    }

    public function bootedPageHasContextMenu(): void
    {
        $this->cacheContextMenuActions();
    }

    protected function cacheContextMenuActions(): void
    {
        foreach ($this->getContextMenuActions() as $action) {

            if (! $action instanceof Action and ! $action instanceof ContextMenuDivider) {
                throw new InvalidArgumentException('context menu action must be an instance of ' . Action::class . '.');
            }

            if ($action instanceof Action or $action instanceof ContextMenuDivider) {
                $this->cacheAction($action);
                $this->cachedContextMenuActions[] = $action;
            }
        }
    }

    public function getCachedContextMenuActions(): array
    {
        return $this->cachedContextMenuActions;
    }

    public function getContextMenuActions(): array
    {
        return [];
    }
}
