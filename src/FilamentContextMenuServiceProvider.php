<?php

namespace AymanAlhattami\FilamentContextMenu;

use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
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
            ->hasViewComponents(static::$viewNamespace);
    }
}
