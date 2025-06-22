# Filament FQN Settings
Create, manage and keep track of your settings with ease.  
Settings are stored as simple key => value pairs to keep it very simple.  
Every setting will exists as a class which is mirrored in the database.
Every entry is auto-discovered!

## Content
- [File Structure](#file-structure)
- [Auto Discovery](#auto-discovery)

- [Installation](#installation)
- [Register Plugin](#register-to-panel)

- [Setting Value Resource](#setting-value-resource)

- [Create Setting](#create-setting-command)
- [Create Schema](#create-schema-command)
- [Create Page](#create-page-command)

- [Adding Values](#adding-values-to-schema)
- [Adding Schemas](#adding-schemas-to-pages)

## File Structure

```
App
    ├── Filament
    │└── Settings
    │    ├── {{ Pages }}
    │    └── Schemas
    │        └── {{ Schemas }}
    └── Settings
        └── MaxDate
```

- One panel can have multiple setting pages
- One page can have multiple setting schemas
- One schema can have multiple setting values

## Auto Discovery
Pages in App\Filament\Settings\Pages will be discovered automagically. 

## Installation
The Package is available for Filament v3 and v4.

### Install Using Composer

```shell
composer require e2d2-dev/filament3-fqn-settings
```
### Register to Panel
Add this into your Filament `PannelProvider` class `panel()`
```php
use Betta\Filament\FqnSettings\FqnSettingsPlugin;

$panel
    ->plugins([FqnSettingsPlugin::make()]);
```

## Create Setting Command
Creates a new setting in App\Settings. The name can contain "\", this will create folders.

```shell
php artisan make:setting
```

## Create Schema Command
Creates a new setting schema in App\Filament\Settings\Schemas.

```shell
php artisan setting:schema
```

## Adding Values to Schema
One page can hold many setting values. Register them in the ```$fqnSettings``` array

```php
    protected array $fqnSettings = [
        FirstValue::class,
        SecondValue::class,
    ];
```

## Create Page Command
Creates a new setting page in App\Filament\Settings.

```shell
php artisan setting:page
```

## Adding Schemas to Pages
One page can hold many setting schemas. Register them in the ```$settingComponents``` array

```php
    protected array $settingComponents = [
        SomeSchema::class,
        OneMoreSchema::class,
    ];
```


## Setting Value Resource
### Sync Action
Calls artisan settings:sync

### Create Page
When your app is running local, settings can be created as database and as file. 

### Edit Page
#### Cache Action
The value can be purged from Cache.


# Credits
- Whole Filament Team :)
