<?php

namespace AymanAlhattami\FilamentContextMenu;

use Closure;
use Filament\Actions\Action;
use Filament\Support\Concerns\EvaluatesClosures;

class ContextMenu
{
    use EvaluatesClosures;

    private string | null | Closure $title = null;

    private Closure | bool $translateTitle = false;

    private array | Closure $actions = [];

    public static function make(): self
    {
        return new self;
    }

    public function getTitle(): ?string
    {
        if ($this->isTitleTranslatable()) {
            return __($this->evaluate($this->title));
        }

        return $this->evaluate($this->title);
    }

    public function title(string | Closure $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function translateTitle(bool | Closure $translateTitle = true): static
    {
        $this->translateTitle = $translateTitle;

        return $this;
    }

    public function isTitleTranslatable(): bool
    {
        return (bool) $this->evaluate($this->translateTitle);
    }

    public function getActions(): array
    {
        return $this->evaluate($this->actions);
    }

    /**
     * @param  array<Action>  $actions
     */
    public function actions(array | Closure $actions): static
    {
        $this->actions = $actions;

        return $this;
    }
}
