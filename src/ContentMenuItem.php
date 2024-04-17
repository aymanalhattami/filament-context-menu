<?php

namespace AymanAlhattami\FilamentContextMenu;

class ContentMenuItem
{
    private ?string $title = null;

    private ?string $url = null;

    private ?string $icon = null;

    private ?string $target = null;

    public static function make(): static
    {
        return new static;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function title(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function url(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function icon(?string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getTarget(): ?string
    {
        return $this->target;
    }

    public function target(?string $target): static
    {
        $this->target = $target;

        return $this;
    }
}
