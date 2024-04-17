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
use VendorName\Skeleton\Testing\TestsSkeleton;

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

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/skeleton/{$file->getFilename()}"),
                ], 'skeleton-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsSkeleton());
    }

    protected function getAssetPackageName(): ?string
    {
        return ':vendor_slug/:package_slug';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('skeleton', __DIR__ . '/../resources/dist/components/skeleton.js'),
            Css::make('skeleton-styles', __DIR__ . '/../resources/dist/filament-context-menu.css'),
            Js::make('skeleton-scripts', __DIR__ . '/../resources/dist/filament-context-menu.js'),
        ];
    }
}
