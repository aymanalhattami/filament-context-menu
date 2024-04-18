<?php

namespace AymanAlhattami\FilamentContextMenu;

class ContentMenuItem
{
    private Closure | string | null $title = null;

    private Closure | string | null $url = null;

    private Closure | string | null $icon = null;

    // _blank, _self, _parent, _top
    private Closure | string $target = '_self';

    public static function make(): static
    {
        return new static;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function title(Closure | string | null $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function url(Closure | string | null $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function icon(Closure | string | null $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getTarget(): ?string
    {
        return $this->target;
    }

    public function target(Closure | string | null $target): static
    {
        $this->target = $target;

        return $this;
    }
}
