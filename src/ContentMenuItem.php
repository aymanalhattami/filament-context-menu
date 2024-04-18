<?php

namespace AymanAlhattami\FilamentContextMenu;

use Closure;
use Filament\Actions\Action;
use Filament\Support\Concerns\EvaluatesClosures;

class ContentMenuItem
{
    use EvaluatesClosures;

    private Closure | string | null $title = null;

    private Closure | bool $translateTitle = false;

    private Closure | string | null | Action $url = null;

    private Closure | string | null $icon = null;

    // _blank, _self, _parent, _top
    private Closure | string $target = '_self';

    public static function make(): static
    {
        return new static;
    }

    public function getTitle(): ?string
    {
        if ($this->isTitleTranslatable()) {
            return __($this->evaluate($this->title));
        }

        return $this->evaluate($this->title);
    }

    public function title(Closure | string | null $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function translateTitle(Closure | bool $tranlateTitle = true): static
    {
        $this->translateTitle = $tranlateTitle;

        return $this;
    }

    public function isTitleTranslatable(): bool
    {
        return (bool) $this->evaluate($this->translateTitle);
    }

    public function getUrl(): string | Action | null
    {
        return $this->evaluate($this->url);
    }

    public function url(Closure | string | null | Action $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->evaluate($this->icon);
    }

    public function icon(Closure | string | null $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getTarget(): ?string
    {
        return $this->evaluate($this->target);
    }

    public function target(Closure | string | null $target): static
    {
        $this->target = $target;

        return $this;
    }
}
