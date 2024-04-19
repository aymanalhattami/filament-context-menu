<?php

namespace AymanAlhattami\FilamentContextMenu;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentContextMenuServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-context-menu';

    public static string $viewNamespace = 'filament-context-menu';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasAssets()
            ->hasViews()
            ->hasViewComponents(static::$viewNamespace);
    }

    public function packageBooted(): void
    {
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentView::registerRenderHook(
            PanelsRenderHook::PAGE_END,
            fn () => view('filament-context-menu::components.context-menu'),
        );
    }

    protected function getAssetPackageName(): ?string
    {
        return 'aymanalhattami/filament-context-menu';
    }

    protected function getAssets(): array
    {
        return [
            Css::make('filament-context-menu-styles', __DIR__ . '/../resources/dist/app.css'),
        ];
    }
}
