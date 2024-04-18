<?php

namespace AymanAlhattami\FilamentContextMenu;

use App\Helper\ContentMenuItem;
use Filament\Actions\Action;

class ContentMenu
{
    private ?string $title = null;

    private array $items = [];

    public static function make(): static
    {
        return new static();
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

    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param  array<ContentMenuItem|Action>  $items
     */
    public function items(array $items): static
    {
        $this->items = $items;

        return $this;
    }
}
