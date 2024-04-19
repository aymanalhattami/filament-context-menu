# Context Menu for Filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/aymanalhattami/filament-context-menu.svg?style=flat-square)](https://packagist.org/packages/aymanalhattami/filament-context-menu)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/aymanalhattami/filament-context-menu/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/aymanalhattami/filament-context-menu/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/aymanalhattami/filament-context-menu/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/aymanalhattami/filament-context-menu/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/aymanalhattami/filament-context-menu.svg?style=flat-square)](https://packagist.org/packages/aymanalhattami/filament-context-menu)

---
This package is used to add context menu for resource pages and custom pages of [Filament Admin Panel](https://filamentphp.com/)
* Support dark and light mode
* Support LTR and RTL direction
* Support Divider between menu items
* Use of ```Filament\Actions\Action``` to set menu items.

## Installation

You can install the package via composer:

```bash
composer require aymanalhattami/filament-context-menu
```

## Usage
1. Define a ```getContextMenu``` method inside the page, the method should return and instance of ```ContentMenu```
2. Use ```ContentMenu``` class to set menu items as an array

```php
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\ContextMenu;
use AymanAlhattami\FilamentContextMenu\ContentMenuDivider;
use Filament\Actions\Action;

class ListMarkets extends ListRecords
{
    // 
    
    public static function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                    Action::make()
                        ->label('Create market')
                        ->translateLabel()
                        ->link()
                        ->color('gray')
                        ->url(CreateMarket::getUrl())
                        ->icon('heroicon-o-plus-circle'),
                    ImportAction::make()
                        ->link()
                        ->label('Excel import')
                        ->translateLabel()
                        ->importer(MarketImporter::class)
                        ->icon('heroicon-o-arrow-up-tray'),
                    Action::make('Upload images')
                        ->translateLabel()
                        ->link()
                        ->icon('heroicon-o-photo')
                        ->modalWidth(MaxWidth::ExtraLarge)
                        ->color('gray')
                        ->form(/* form inputs */)
                        ->action(/* you own handling */),
                    ContentMenuDivider::make(),
                    Action::make('requested_markets')
                        ->label('Requested Markets')
                        ->link()
                        ->color('gray')
                        ->url(CreateMarket::getUrl())
                        ->badge(25)
                        ->icon('heroicon-o-building-storefront'),
                    Action::make('requested_markets')
                        ->label('Closed markets')
                        ->link()
                        ->color('gray')
                        ->url(CreateMarket::getUrl())
                        ->badge(4)
                        ->icon('heroicon-o-building-storefront'),
                ]);
    }
    
    // 
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [aymanalhattami](https://github.com/aymanalhattami)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
