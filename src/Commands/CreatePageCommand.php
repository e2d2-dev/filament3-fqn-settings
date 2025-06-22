<?php

namespace Betta\Filament\FqnSettings\Commands;

use Betta\Filament\FqnSettings\Commands\FileGenerators\SettingPageClassGenerator;
use Betta\Settings\Commands\Concerns\CanAskForComponentLocation;
use Betta\Settings\Commands\Concerns\CanManipulateFiles;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

use function Laravel\Prompts\text;

#[AsCommand(name: 'setting:page')]
class CreatePageCommand extends Command
{
    use CanAskForComponentLocation;
    use CanManipulateFiles;

    protected string $attributeFqn;

    protected string $fqnEnd;

    protected string $attributePath;

    protected $description = 'Creates setting page';

    public function handle(): void
    {
        $this->configureName();

        $this->configureLocation();

        $this->writeFile($this->attributePath, app(SettingPageClassGenerator::class, [
            'fqn' => "App\\Filament\\Settings\\Pages\\{$this->name}",
            'name' => $this->name,
        ]));
    }

    protected function getOptions(): array
    {
        return [
            new InputOption(
                name: 'name',
                mode: InputOption::VALUE_REQUIRED,
            ),
        ];
    }

    protected function configureName(): void
    {
        $this->name = (string) str($this->option('name') ?? text(
            label: 'What is the page name?',
            placeholder: 'name',
            required: true,
        ))
            ->studly();
    }

    protected function configureLocation(): void
    {
        [
            $namespace,
            $path,
        ] = $this->askForComponentLocation(
            path: 'Schemas',
            question: 'Where would you like to create the schema?',
        );

        $this->attributeFqn = "{$namespace}\\Filament\\Settings\\{$this->name}";
        $this->attributePath = (string) str(app_path()."\\Filament\\Settings\\Pages\\{$this->name}.php")
            ->replace('\\', '/')
            ->replace('//', '/');
    }
}
