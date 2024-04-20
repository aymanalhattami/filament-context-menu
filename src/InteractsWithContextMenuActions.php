<?php

namespace AymanAlhattami\FilamentContextMenu;

use Filament\Actions\Action;
use InvalidArgumentException;

trait InteractsWithContextMenuActions
{
    protected array $cachedContextMenuActions = [];

    public function bootedInteractsWithContextMenuActions(): void
    {
        $this->cacheContextMenuActions();
    }

    protected function cacheContextMenuActions(): void
    {
        foreach ($this->getContextMenuActions() as $action) {

            if (! $action instanceof Action and ! $action instanceof ContextMenuDivider) {
                throw new InvalidArgumentException('context menu action must be an instance of ' . Action::class . '.');
            }

            if ($action instanceof Action) {
                $this->cacheAction($action);
                $this->cachedContextMenuActions[] = $action;
            }
        }
    }

    public function getCachedContextMenuActions(): array
    {
        return $this->cachedContextMenuActions;
    }

    public function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()->actions($this->getCachedContextMenuActions());
    }

    public function getContextMenuActions(): array
    {
        return [];
    }
}
