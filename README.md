# Filament FQN Settings

[![Latest Version on Packagist](https://img.shields.io/packagist/v/e2d2-dev/laravel-fqn-settings.svg?style=flat-square)](https://packagist.org/packages/e2d2-dev/laravel-fqn-settings)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Create, manage and keep track of your settings with ease.

## FQN-Settings Concept

- stored as simple key => value pairs to keep it simple stupid
- exist as classes which are mirrored to the database
- cache enabled
- auto-discovery
- auto deployment on composer install
- default values on classes

## Features
- Management of values
- Creation of settings
- Creation of Filament setting pages and schemas

## Table of Contents

- [File Structure](#file-structure)
- [Installation](#installation)
  - [Install Using Composer](#install-using-composer)
  - [Register to Panel](#register-to-panel)
- [Auto Discovery](#auto-discovery)
  - [Pages Auto Discovery](#pages-auto-discovery)
  - [Settings Auto Discovery](#settings-auto-discovery)
  - [Package Auto Discovery](#package-auto-discovery)
- [Commands](#commands)
  - [Create Setting Command](#create-setting-command)
  - [Create Schema Command](#create-schema-command)
  - [Create Page Command](#create-page-command)
- [Working with Settings](#working-with-settings)
  - [Adding Values to Schema](#adding-values-to-schema)
  - [Adding Fields to Schemas](#adding-fields-to-schemas)
  - [Using $get() and $set()](#using-get-and-set)
  - [Modifying Schema Return Type](#modifying-schema-return-type)
  - [Schema - Common Methods](#schema---common-methods)
  - [Schema - Tabs](#schema---tabs)
  - [Adding Schemas to Pages](#adding-schemas-to-pages)
  - [Mutating Data Before Save](#mutating-data-before-save)
  - [Fill Additional Data](#fill-additional-data)
  - [Add Components Before/After Schema](#add-components-beforeafter-schema)
- [Setting Value Resource](#setting-value-resource)
  - [Sync Action](#sync-action)
  - [Create Page](#create-page)
  - [Cache Action](#cache-action)
- [Special Features](#special-features)
  - [Lost Settings](#lost-settings)
  - [Encrypted Settings](#encrypted-settings)
- [Contributing](#contributing)
- [Credits](#credits)

## File Structure

```
App
    ├── Filament
    │└── Settings
    │    ├── {{ Pages }}
    │    └── Schemas
    │        └── {{ Schemas }}
    └── Settings
        └── MaxDateSetting // Example Setting
```

- One panel can have multiple setting pages
- One page can have multiple setting schemas
- One schema can have multiple setting values


## Installation
The Package is available for Filament v3 and v4.

### Install Using Composer

```shell
composer require e2d2-dev/filament-fqn-settings
```

### Register to Panel
Add `FqnSettingsPlugin::make()` into your Filament `PanelProvider` class `panel()` method to register the ValueResource:

```php
use Betta\Filament\FqnSettings\FqnSettingsPlugin;
use Filament\Panel;
use Filament\PanelProvider;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->plugins([
                FqnSettingsPlugin::make(),
            ]);
    }
}
```

## Auto Discovery

### Pages Auto Discovery
Pages in `App\Filament\Settings\Pages` will be discovered automatically. The `SettingPage` is a regular Filament Page and can be added to the `pages()` method.

### Settings Auto Discovery
More directories can be added to the config file:

```shell
# Publish the config file
php artisan vendor:publish --tag=laravel-fqn-settings-config
```

```php
// {config_path}/fqn-settings.php
return [
    'discover' => [
        // 'app-modules/settings/src/SomePackage' => 'Vendor\\Package\\Settings',
    ],
];
```

### Package Auto Discovery
Directories can also be added in the `register()` method inside Service Providers:

```php
use Betta\Settings\Settings;

class SomeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Settings::path(
            'path/to/files',
            'Vendor\\Package'
        );
    }
}
```

## Commands

### Create Setting Command
Creates a new setting in `App\Settings`. The name can contain backslashes (`\`), which will create nested folders and namespaces.

```shell
php artisan make:setting
```

### Create Schema Command
Creates a new setting schema in `App\Filament\Settings\Schemas`.

```shell
php artisan setting:schema
```

### Create Page Command
Creates a new setting page in `App\Filament\Settings\Pages`.

```shell
php artisan setting:page
```

## Working with Settings

### Adding Values to Schema
One schema can hold many setting values. Register them in the `$fqnSettings` array:

```php
use Betta\Filament\FqnSettings\Values\SettingSchema;

class BaseSchema extends SettingSchema
{
    protected array $fqnSettings = [
        SomeValue::class,
        SecondValue::class,
    ];
}
```

### Adding Fields to Schemas
Add components to the `schema()` method like in regular resource pages. Pass the class name calling statically `getStatePath()`.  
This will set the state path of the component accordingly:

```php
use Betta\Filament\FqnSettings\Values\SettingSchema;
use Filament\Forms\Components\TextInput;
use App\Settings\SomeValue;

class BaseSchema extends SettingSchema
{
    protected array $fqnSettings = [
        SomeValue::class,
    ];

    public function schema(): array
    {
        return [
            TextInput::make(SomeValue::getStatePath()),
        ];
    }
}
```

### Using $get() and $set()
Both methods need a state path to work properly. This can be achieved by using `getStatePath()`:

```php
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use App\Settings\SomeValue;
use App\Settings\OtherValue;

TextInput::make(SomeValue::getStatePath()),

TextInput::make(OtherValue::getStatePath())
    ->visible(fn(Get $get) => $get(SomeValue::getStatePath())),
```

### Modifying Schema Return Type
A Schema can be returned as plain array, Section, Group, Fieldset, Tab, or Tabs by changing the `$returnAs` property. An Enum is provided:

```php
use App\Settings\SomeValue;
use Betta\Filament\FqnSettings\Enums\SchemaAs;
use Betta\Filament\FqnSettings\Values\SettingSchema;

class BaseSchema extends SettingSchema
{
    protected \BackedEnum $returnAs = SchemaAs::Section;

    // Rest of your schema class...
}
```

### Schema - Common Methods
Methods like Heading, Description, Icon, etc., which are common across layout components, can be used in the schema class like on resource pages. This allows switching layouts with minimal effort:

```php
use Betta\Filament\FqnSettings\Values\SettingSchema;
use Illuminate\Contracts\Support\Htmlable;
use Closure;

class BaseSchema extends SettingSchema
{
    public function getHeading(): string|Htmlable|Closure|null
    {
        return 'My Schema Heading';
    }

    public function getDescription(): string|Htmlable|Closure|null
    {
        return 'This is a description of my schema';
    }

    public function getIcon(): string|Htmlable|Closure|null
    {
        return 'heroicon-o-cog';
    }

    public function getIconColor(): string|array|null
    {
        return 'primary';
    }

    public function columnSpan(?int $columnSpan = 1): int
    {
        return $columnSpan;
    }

    public function columns(?int $columns = 1): int
    {
        return $columns;
    }
}
```

### Schema - Tabs
Methods ending with "Tab" will be called automatically. The function name will be converted to title using `str($name)->title()`:

```php
use Filament\Forms\Components\Tabs\Tab;
use Betta\Filament\FqnSettings\Values\SettingSchema;

class BaseSchema extends SettingSchema
{
    public function baseTab(Tab $tab): Tab 
    {
        return $tab->schema([
            // Components
        ]);
    }

    public function advancedTab(Tab $tab): Tab 
    {
        return $tab->schema([
            // Components
        ]);
    }
}
```


### Adding Schemas to Pages
One page can hold many setting schemas. Register them in the `$settingComponents` array:

```php
use Betta\Filament\FqnSettings\Pages\SettingPage;
use App\Filament\Settings\Schemas\SomeSchema;
use App\Filament\Settings\Schemas\OneMoreSchema;

class SettingsPage extends SettingPage
{
    protected array $schemas = [
        SomeSchema::class,
        OneMoreSchema::class,
    ];
}
```

### Mutating Data Before Save
You can mutate the data before it's saved, just like on regular resource pages:

```php
use Betta\Filament\FqnSettings\Pages\SettingPage;

class SettingsPage extends SettingPage
{
    public function mutateSaveDataUsing(array $data): array
    {
        // Modify $data as needed
        return $data;
    }
}
```

### Fill Additional Data
Add more data to the page:

```php
use Betta\Filament\FqnSettings\Pages\SettingPage;

class SettingsPage extends SettingPage
{
    public function fillAdditionalData(): array
    {
        return [
            'customData' => 'value',
            'anotherCustomData' => [
                'nested' => 'value',
            ],
        ];
    }
}
```

### Add Components Before/After Schema
You can add additional components before or after the schema:

```php
use Betta\Filament\FqnSettings\Pages\SettingPage;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Placeholder;

class SettingsPage extends SettingPage
{
    public function beforeSchema(): array
    {
        return [
            Section::make('Before Schema Section')
                ->schema([
                    Placeholder::make('info')
                        ->content('This appears before the schema'),
                ]),
        ];
    }

    public function afterSchema(): array
    {
        return [
            Section::make('After Schema Section')
                ->schema([
                    Placeholder::make('info')
                        ->content('This appears after the schema'),
                ]),
        ];
    }
}
```

## Setting Value Resource
The package includes a Filament resource for managing setting values directly.

### Sync Action
The Sync action calls the `artisan settings:sync` command to synchronize settings between the database and the code.

### Create Page
When your app is running in the "local" environment, settings can be created both in the database and as a file.

### Cache Action
The Cache action allows you to purge a specific value from the cache, which can be useful during development or when troubleshooting.

## Special Features

### Lost Settings
When a setting class is moved or is no longer available, the setting will persist in the database. These entries will be marked as "lost" in the UI, allowing you to identify and manage orphaned settings.

### Encrypted Settings
Settings that use encryption are marked with a green fingerprint icon in the UI, making it easy to identify which values are stored securely.

## Contributing
Ideas, bug reports, and pull requests are welcome! Feel free to contribute to the development of this package.

## Credits
- The entire Filament Team for creating an amazing admin panel framework
- All contributors to this package
