<?php

namespace AymanAlhattami\FilamentContextMenu;

use Closure;
use Filament\Actions\Action;
use Filament\Support\Concerns\EvaluatesClosures;

class ContentMenu
{
    use EvaluatesClosures;

    private string | null | Closure $title = null;

    private Closure | bool $translateTitle = false;

    private array | Closure $items = [];

    public static function make(): static
    {
        return new static();
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

    public function getItems(): array
    {
        return $this->evaluate($this->items);
    }

    /**
     * @param  array<ContentMenuItem|Action>  $items
     */
    public function items(array | Closure $items): static
    {
        $this->items = $items;

        return $this;
    }
}
