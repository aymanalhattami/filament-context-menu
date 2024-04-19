# Context Menu for Filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/aymanalhattami/filament-context-menu.svg?style=flat-square)](https://packagist.org/packages/aymanalhattami/filament-context-menu)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/aymanalhattami/filament-context-menu/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/aymanalhattami/filament-context-menu/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/aymanalhattami/filament-context-menu/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/aymanalhattami/filament-context-menu/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/aymanalhattami/filament-context-menu.svg?style=flat-square)](https://packagist.org/packages/aymanalhattami/filament-context-menu)

---
This package is used to add context menu (right click menu) for resource pages and custom pages of [Filament Admin Panel](https://filamentphp.com/).
* Support dark and light mode.
* Support left-to-right and right-to-left direction.
* You can set a divider between menu items.
* It uses [Filament Actions](https://filamentphp.com/docs/3.x/actions/overview) to set menu items.

## Installation

You can install the package via composer:

```bash
composer require aymanalhattami/filament-context-menu
```

## Usage
1. Define a ```getContextMenu``` method inside the page (resource page or custom page), the method should return and instance of ```AymanAlhattami\FilamentContextMenu\ContextMenu```
2. Use ```ContextMenu``` class to set menu actions as an array

```php
use App\Filament\Resources\UserResource\Pages\CreateUser;
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\ContextMenu;
use Filament\Actions\Action;

class ListUsers extends ListRecords
{
    // 
    
    public static function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                Action::make('Create user')
                    ->url(CreateUser::getUrl())
            ]);
    }
    
    // 
}
```

### Divider
Use ```AymanAlhattami\FilamentContextMenu\ContextMenuDivider``` to set divider between items
```php
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\TrashedUsers;
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\ContextMenu;
use Filament\Actions\Action;
use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;

class ListUsers extends ListRecords
{
    // 
    
    public static function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                Action::make('Create user')
                    ->url(CreateUser::getUrl()),
                ContextMenuDivider::make(),
                Action::make('Trashed user')
                    ->url(TrashedUsers::getUrl()),
            ]);
    }
    
    // 
}
```

### Create Action
use ```Filament\Actions\CreateAction``` as an item action for context menu 

```php
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\ContextMenu;

class ListUsers extends ListRecords
{
    // 
    
    public static function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                \Filament\Actions\CreateAction::make()
            ]);
    }
    
    // 
}
```

### Edit Action
use ```Filament\Actions\EditAction``` as an item action for context menu

```php
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\ContextMenu;

class ListUsers extends ListRecords
{
    // 
    
    public static function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                \Filament\Actions\EditAction::make()
            ]);
    }
    
    // 
}
```

### View Action
use ```Filament\Actions\ViewAction``` as an item action for context menu

```php
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\ContextMenu;

class ListUsers extends ListRecords
{
    // 
    
    public static function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                \Filament\Actions\ViewAction::make()
            ]);
    }
    
    // 
}
```

### Delete Action
use ```Filament\Actions\DeleteAction``` as an item action for context menu

```php
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\ContextMenu;

class ListUsers extends ListRecords
{
    // 
    
    public static function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                \Filament\Actions\DeleteAction::make()
            ]);
    }
    
    // 
}
```

### Export Action
use ```Filament\Actions\ExportAction``` as an item action for context menu

```php
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\ContextMenu;

class ListUsers extends ListRecords
{
    // 
    
    public static function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                \Filament\Actions\ExportAction::make()
            ]);
    }
    
    // 
}
```

### Export Action
use ```Filament\Actions\ExportAction``` as an item action for context menu

```php
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\ContextMenu;

class ListUsers extends ListRecords
{
    // 
    
    public static function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                \Filament\Actions\ExportAction::make()
            ]);
    }
    
    // 
}
```

### Force Delete Action
use ```Filament\Actions\ForceDeleteAction``` as an item action for context menu

```php
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\ContextMenu;

class ListUsers extends ListRecords
{
    // 
    
    public static function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                \Filament\Actions\ForceDeleteAction::make()
            ]);
    }
    
    // 
}
```

### Import Action
use ```Filament\Actions\ForceDeleteAction``` as an item action for context menu

```php
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\ContextMenu;

class ListUsers extends ListRecords
{
    // 
    
    public static function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                \Filament\Actions\ImportAction::make()
            ]);
    }
    
    // 
}
```

### Replicate Action
use ```Filament\Actions\ReplicateAction``` as an item action for context menu

```php
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\ContextMenu;

class ListUsers extends ListRecords
{
    // 
    
    public static function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                \Filament\Actions\ReplicateAction::make()
            ]);
    }
    
    // 
}
```

### Restore Action
use ```Filament\Actions\RestoreAction``` as an item action for context menu

```php
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\ContextMenu;

class ListUsers extends ListRecords
{
    // 
    
    public static function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                \Filament\Actions\RestoreAction::make()
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
