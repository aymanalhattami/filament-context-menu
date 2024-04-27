<?php

namespace AymanAlhattami\FilamentContextMenu\Traits;

use Closure;

trait ColumnHasContextMenu
{
    protected string $wrapperView = 'filament-context-menu::filament.tables.columns.context-menu-column';

    protected ?string $mainView = '';

    protected Closure | bool $contextMenuEnabled = true;

    protected Closure | array $contextMenuActions = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->mainView($this->getView())
            ->view($this->getWrapperView());
    }

    public function getContextMenuActions(): array
    {
        return $this->evaluate($this->contextMenuActions);
    }

    public function contextMenuActions(array | Closure $contextMenuActions): static
    {
        $this->contextMenuActions = $contextMenuActions;

        return $this;
    }

    public function enableContextMenu(bool | Closure $contextMenuEnabled = true): static
    {
        $this->contextMenuEnabled = $contextMenuEnabled;

        return $this;
    }

    public function isContextMenuEnabled(): bool
    {
        $isContextMenuEnabled = $this->evaluate($this->contextMenuEnabled);

        return $isContextMenuEnabled and
            config('filament-context-menu.enabled', true) and
            count($this->getContextMenuActions());
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
