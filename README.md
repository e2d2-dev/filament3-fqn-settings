# Filament FQN Settings
Create, manage and keep track of your settings with ease.  


# Introduction
Settings are stored as simple key => value pairs to keep it very simple.  
Every setting will exists as a class which is mirrored in the database.
Every entry is auto-discovered!

# Filament Features
- Set-up Setting Pages

## Content
- [File Structure](#file-structure)
- [Auto Discovery](#auto-discovery)

- [Installation](#installation)
- [Register Plugin](#register-to-panel)

- [Setting Value Resource](#setting-value-resource)

- [Create Settings](#create-setting-command)
- [Create Schemas](#create-schema-command)
- [Create Pages](#create-page-command)

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
composer require e2d2-dev/filament-fqn-settings
```
### Register to Panel
Add this into your Filament `PannelProvider` class `panel()` to register the ValueResource.

```php
use Betta\Filament\FqnSettings\FqnSettingsPlugin;

$panel
    ->plugins([
      FqnSettingsPlugin::make(),
    ]);
```

## Create Setting Command
Creates a new setting in App\Settings. The name can contain "\", this will create nested Folders/Namespaces.

```shell
php artisan make:setting
```

## Create Schema Command
Creates a new setting schema in App\Filament\Settings\Schemas.

```shell
php artisan setting:schema
```

## Adding Values to Schema
One page can hold many setting values. Register them in the ```$fqnSettings``` array.

```php
use Betta\Filament\FqnSettings\Pages\SettingPage;

class BaseSettings extends SettingPage
{
    protected array $fqnSettings = [
        SomeValue::class,
        SecondValue::class,
    ];
```

## Adding Fields to Schemas
Add components to the ```schema()``` method like in regular resource pages. Pass the class name calling statically ```getStatePath()```.  
This will set the statepath of the component accordingly.

```php
use Betta\Filament\FqnSettings\Values\SettingSchema;
use \Filament\Forms\Components\TextInput;
use App\Settings\FirstValue::class;

class BaseSettings extends SettingSchema
{
    protected array $fqnSettings = [
        SomeValue::class,
    ];
    
   public function schema(): array
   {
      return  [
         TextInput::make(SomeValue::getStatePath()),
      ]  
   }
```

## Modifying Schema Return Type 
A Schema can be returned as plain array, Section, Group, Fieldset, Tab and Tabs by changing the ```$returnAs``` Property. An Enum is provided.

```php
use App\Settings\FirstValue::class;
use Betta\Filament\FqnSettings\Enums\SchemaAs;
use Betta\Filament\FqnSettings\Values\SettingSchema;

class BaseSettings extends SettingSchema
{
    protected \BackedEnum $returnAs = SchemaAs::Section;
```

## Schema - Common Methods
Methods like Heading, Description, Icon... which are common through layout components can be used in the schema class like on resource pages.  
This allows switching Layouts with no effort.

```php
use Betta\Filament\FqnSettings\Values\SettingSchema;

class BaseSettings extends SettingSchema
{
    public function getHeading(): string|Htmlable|Closure|null
       
    public function getDescription(): string|Htmlable|Closure|null
    
    public function getIcon(): string|Htmlable|Closure|null
    
    public function getIconColor(): string|array|null
    
    public function columnSpan(?int $columnSpan = 1): int

    public function columns(?int $columns = 1): int

```

## Schema - Tabs
Methods ending with "Tab" will be called automagically. The function name will be converted to title using ```str($name)->title()```

```php
use \Filament\Schemas\Components\Tabs\Tab;

    public function baseTab(Tab $tab): Tab {
      return $tab->schema([
            // Components
      ]);
   } 
```
## Schema - Tabs
Methods ending with "Tab" will be called automagically. The function name will be converted to title using ```str($name)->title()```

## Mutate data before save
Same as on resource pages.

```php
    public function mutateSaveDataUsing(array $data): array
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
When your app is running in state "local", settings can be created as database and as file. 

#### Cache Action
The value can be purged from Cache.


# Credits
- Whole Filament Team :)
