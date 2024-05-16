<?php

namespace AymanAlhattami\FilamentContextMenu\Traits;

use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
use Filament\Actions\Action;
use InvalidArgumentException;

trait PageHasContextMenu
{
    protected array $cachedContextMenuActions = [];

    protected static bool $contextMenuEnabled = true;

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
                $this->cachedContextMenuActions[] = $this->cacheAction($action);
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

    public function isContextMenuEnabled(): bool
    {
        return static::$contextMenuEnabled and
            config('filament-context-menu.enabled', true)
            and count($this->getContextMenuActions());
    }
}
