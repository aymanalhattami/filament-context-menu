<?php

namespace AymanAlhattami\FilamentContextMenu\Traits;

use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
use Filament\Actions\Action;
use InvalidArgumentException;

trait ColumnHasContextMenu
{
    protected string $wrapperView = 'filament-context-menu::filament.tables.columns.context-menu-column';

    protected ?string $mainView = '';

    protected \Closure | array $contextMenuActions = [];
    protected array $cachedContextMenuActions = [];

    /**
     * @throws \Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->mainView($this->getView())
            ->view($this->getWrapperView());
    }

    public function bootedColumnHasContextMenu(): void
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
        return $this->evaluate($this->contextMenuActions);
    }

    public function contextMenuActions(array | \Closure $contextMenuActions): static
    {
        $this->contextMenuActions = $contextMenuActions;

        return $this;
    }

    public function wrapperView($view): static
    {
        $this->wrapperView = $view;

        return $this;
    }

    public function getWrapperView(): string
    {
        return $this->wrapperView;
    }

    public function mainView($view): static
    {
        $this->mainView = $view;

        return $this;
    }

    public function getMainView(): string
    {
        return $this->mainView;
    }
}
