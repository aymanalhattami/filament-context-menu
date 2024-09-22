# Context Menu for Filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/aymanalhattami/filament-context-menu.svg?style=flat-square)](https://packagist.org/packages/aymanalhattami/filament-context-menu)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/aymanalhattami/filament-context-menu/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/aymanalhattami/filament-context-menu/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/aymanalhattami/filament-context-menu/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/aymanalhattami/filament-context-menu/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/aymanalhattami/filament-context-menu.svg?style=flat-square)](https://packagist.org/packages/aymanalhattami/filament-context-menu)

---
Add a context menu (right click menu) for resource pages, custom pages and table cells of [Filament Admin Panel](https://filamentphp.com/).
* It uses [Filament Actions](https://filamentphp.com/docs/3.x/actions/overview) to set menu actions.
* It supports dark and light modes.
* It supports left-to-right and right-to-left direction.
* You can set a divider between menu actions.
* It supports resource pages and custom pages.
* You can set a context menu for table cells.
* Three actions are available for usage in the page context menu:
    * ```AymanAlhattami\FilamentContextMenu\Actions\RefreshAction``` to refresh the page.
    * ```AymanAlhattami\FilamentContextMenu\Actions\GoBackAction``` to go back to the previous page.
    * ```AymanAlhattami\FilamentContextMenu\Actions\GoForward``` to go back to the forward page.

[Demo project](https://github.com/aymanalhattami/filament-context-menu-project) | [Youtube video](https://www.youtube.com/watch?v=ciTH-u5sluw) | [Laravel Daily (Povilas Korop) Video](https://www.youtube.com/watch?v=ZqJ96GCtfBQ)

## Installation

You can install the package via Composer:

```bash
composer require aymanalhattami/filament-context-menu
```

## Usage 1: resource pages and custom pages
1. Add the trait ```AymanAlhattami\FilamentContextMenu\PageHasContextMenu``` to the page you want to add the context menu.
2. Then, define a ```getContextMenuActions``` method inside the page, the method should return an array of [Filament Actions](https://filamentphp.com/docs/3.x/actions/installation)

```php
use App\Filament\Resources\UserResource\Pages\CreateUser;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    use PageHasContextMenu;
    
    public function getContextMenuActions(): array
    {
        return [
            Action::make('Create user')
                ->url(CreateUser::getUrl())
        ];
    }
    
    // 
}
```

### Divider
You can use ```AymanAlhattami\FilamentContextMenu\ContextMenuDivider``` to set divider between menu actions

```php
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\TrashedUsers;
use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    use PageHasContextMenu;

    // 
    
    public static function getContextMenuActions(): array
    {
        return [
            Action::make('Create user')
                ->url(CreateUser::getUrl()),
            ContextMenuDivider::make(),
            Action::make('Trashed user')
                ->url(TrashedUsers::getUrl()),
        ];
    }
    
    // 
}
```

### Create Action
You can use ```Filament\Actions\CreateAction```, visit [filament create action](https://filamentphp.com/docs/3.x/actions/prebuilt-actions/create) for more information.

```php
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    use PageHasContextMenu;

    // 
    
    public static function getContextMenuActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make()
                ->model(App\Models\User::class)
                 ->form([
                    TextInput::make('name')
                        ->required(),
                    // ...
                ])
        ];
    }
    
    // 
}
```

### Edit Action
You can use ```Filament\Actions\EditAction```, visit [filament edit action](https://filamentphp.com/docs/3.x/actions/prebuilt-actions/edit) for more information.

```php
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    use PageHasContextMenu;

    // 
    
    public static function getContextMenuActions(): array
    {
        return [
            \Filament\Actions\EditAction::make()
                ->record($this->user)
                ->form([
                    TextInput::make('name')
                        ->required(),
                    // ...
                ])
        ];
    }
    
    // 
}
```

### View Action
You can use ```Filament\Actions\ViewAction```, visit [filament view action](https://filamentphp.com/docs/3.x/actions/prebuilt-actions/view) for more information.

```php
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    use PageHasContextMenu;

    // 
    
    public static function getContextMenuActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make()
                ->record($this->user)
                 ->form([
                    TextInput::make('name')
                        ->required(),
                    // ...
                ])
                
        ];
    }
    
    // 
}
```

### Delete Action
You can use  ```Filament\Actions\DeleteAction```, visit [filament delete action](https://filamentphp.com/docs/3.x/actions/prebuilt-actions/delete) for more information.

```php
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    use PageHasContextMenu;

    // 
    
    public static function getContextMenuActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make()
                ->record($this->user)
        ];
    }
    
    // 
}
```

### Replicate Action
You can use  ```Filament\Actions\ReplicateAction```, visit [filament replicate action](https://filamentphp.com/docs/3.x/actions/prebuilt-actions/replicate) for more information.

```php
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    use PageHasContextMenu;

    // 
    
    public static function getContextMenuActions(): array
    {
        return [
            \Filament\Actions\ReplicateAction::make()
                ->record($this->user)
        ];
    }
    
    // 
}
```

### Force Delete Action
You can use ```Filament\Actions\ForceDeleteAction```, visit [filament force delete action](https://filamentphp.com/docs/3.x/actions/prebuilt-actions/force-delete) for more information.

```php
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    use PageHasContextMenu;

    // 
    
    public static function getContextMenuActions(): array
    {
        return [
            \Filament\Actions\ForceDeleteAction::make()
                ->record($this->user)
        ];
    }
    
    // 
}
```

### Restore Action
You can use ```Filament\Actions\RestoreAction```, visit [filament restore action](https://filamentphp.com/docs/3.x/actions/prebuilt-actions/restore) for more information.

```php
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    use PageHasContextMenu;

    // 
    
    public static function getContextMenuActions(): array
    {
        return [
            \Filament\Actions\RestoreAction::make()
                ->record($this->user)
        ];
    }
    
    // 
}
```

### Import Action
You can use ```Filament\Actions\ImportAction```, visit [filament import action](https://filamentphp.com/docs/3.x/actions/prebuilt-actions/import) for more information.

```php
use App\Filament\Imports\UserImporter;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    use PageHasContextMenu;

    // 
    
    public static function getContextMenuActions(): array
    {
        return [
            \Filament\Actions\ImportAction::make()
                ->importer(UserImporter::class)
        ];
    }
    
    // 
}
```

### Export Action
You can use ```Filament\Actions\ExportAction```, visit [filament export action](https://filamentphp.com/docs/3.x/actions/prebuilt-actions/export) for more information.

```php
use App\Filament\Exports\UserExporter;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    use PageHasContextMenu;

    // 
    
    public static function getContextMenuActions(): array
    {
        return [
            \Filament\Actions\ExportAction::make()
                ->exporter(UserExporter::class)
        ];
    }
    
    // 
}
```

### Example: action with modal
You can use filament action with modal

```php
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;

class ViewUser extends ViewRecord
{
    use PageHasContextMenu;

    // 
    
    public static function getContextMenuActions(): array
    {
        return [
            Action::make('Quick edit user')
                ->form([
                    \Filament\Forms\Components\Grid::make(2)
                        ->schema([
                            TextInput::make('name'),
                            TextInput::make('email'),
                        ])
                ])
                ->action(function($data){
                    $this->getRecord()->update([
                        'name' => $data['name'],
                        'email' => $data['email'],
                    ]);
                })
        ];
    }
    
    // 
}
```

### Example: refresh, go back and go forward actions

```php
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Resources\Pages\ViewRecord;
use AymanAlhattami\FilamentContextMenu\Actions\{ RefreshAction, GoBackAction, GoForwardAction}; 

class ViewUser extends ViewRecord
{
    use PageHasContextMenu;

    // 
    
    public static function getContextMenuActions(): array
    {
        return [
            RefreshAction::make(),
            GoBackAction::make(),
            GoForwardAction::make()
        ];
    }
    
    // 
}
```

### Enable / Disable context menu in resource pages and custom pages
Method 1: To globally enable or disable the context menu, you need to define an env variable called ```CONTEXT_MENU_ENABLED```  and to set the value to ```true``` or ```false```.

Method 2: You can also define a static variable called ```public static bool $contextMenuEnabled``` in the page and set the value to ```true``` or ```false```;

```php
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    use PageHasContextMenu;
    
    # enable / disable context menu
    public static bool $contextMenuEnabled = true;

    // 
    
    public static function getContextMenuActions(): array
    {
        return [];
    }
    
    // 
}
```

Method 3: define a static method called ```isContextMenuEnabled``` in the page

```php
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    use PageHasContextMenu;
    
    public static function isContextMenuEnabled(): bool
    {
        return true;
    }

    // 
    
    public static function getContextMenuActions(): array
    {
        return [];
    }
    
    // 
}
```

## Usage 2: table cells
To add a context menu to the table cell, you can use the following columns: 
```php 
 AymanAlhattami\FilamentContextMenu\Columns\ContextMenuTextColumn;
 AymanAlhattami\FilamentContextMenu\Columns\ContextMenuCheckboxColumn;
 AymanAlhattami\FilamentContextMenu\Columns\ContextMenuSelectColumn;
 AymanAlhattami\FilamentContextMenu\Columns\ContextMenuColorColumn;
 AymanAlhattami\FilamentContextMenu\Columns\ContextMenuIconColumn;
 AymanAlhattami\FilamentContextMenu\Columns\ContextMenuImageColumn; 
 AymanAlhattami\FilamentContextMenu\Columns\ContextMenuTextInputColumn;
 AymanAlhattami\FilamentContextMenu\Columns\ContextMenuToggleColumn;
```

```php
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use AymanAlhattami\FilamentContextMenu\Columns\ContextMenuTextColumn;
use App\Filament\Resources\UserResource\Pages\{ ViewUser, EditUser };

//
public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ContextMenuTextColumn::make('id')
                    ->searchable()
                    ->contextMenuActions(fn (Model $record) => [
                        Action::make('View user')
                            ->url(ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user'),
                    ]),
                ContextMenuTextColumn::make('name')
                    ->searchable()
                    ->contextMenuActions(fn (Model $record) => [
                        Action::make('View user')
                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user'),
                        Action::make('Edit user')
                            ->url(Pages\EditUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-pencil'),
                    ])
                    ,
                ,
            ])
}
```
Use ```AymanAlhattami\FilamentContextMenu\ContextMenuDivider``` to set a divider between menu actions.

### enable / disable table cell context menu
Use ```->contextMenuEnabled()``` method to enable/disable the context menu for the table cell.

```php
//
public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ContextMenuTextColumn::make('id')
                    ->contextMenuEnabled(false)
                    ->contextMenuActions(fn (Model $record) => [
                        Action::make('View user')
                            ->url(ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user'),
                    ]),
//
```

## Note 
For action to have a nice style, use ```->link()``` method of the action, [more information](https://filamentphp.com/docs/3.x/actions/trigger-button#choosing-a-trigger-style)
 
```php
public static function getContextMenuActions(): array
{
    return [
        Action::make('Create user')
            ->url(CreateUser::getUrl())
            ->link()
        ];
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
