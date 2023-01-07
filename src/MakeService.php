<?php

namespace PrevailExcel\ActionServiceTrait;

use Illuminate\Console\GeneratorCommand;

/** 
 * This file is part of the Laravel Action Service Trait package.
 *
 * @author Prevail Ejimadu <prevailexcellent@gmail.com> (C)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class MakeService extends GeneratorCommand
{
    /**
     * STUB_PATH.
     */
    const STUB_PATH = __DIR__ . '/Stubs/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name : Create a service class} {--i : Create a service interface}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class and optional interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

    
    /**
     * @return string
     */
    protected function getStub(): string
    {
        return self::STUB_PATH . 'service.stub';
    }

    /**
     * @return string
     */
    protected function getServiceInterfaceStub(): string
    {
        return self::STUB_PATH . 'service.interface.stub';
    }

    /**
     * @return string
     */
    protected function getInterfaceStub(): string
    {
        return self::STUB_PATH . 'interface.stub';
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @see \Illuminate\Console\GeneratorCommand
     *
     */
    public function handle()
    {
        if ($this->isReservedName($this->getNameInput())) {
            $this->error('The name "' . $this->getNameInput() . '" is reserved by PHP.');

            return false;
        }

        $name = $this->qualifyClass($this->getNameInput());

        $path = $this->getPath($name);

        if ((! $this->hasOption('force') ||
                ! $this->option('force')) &&
            $this->alreadyExists($this->getNameInput())) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        $this->makeDirectory($path);
        $hasInterface = $this->option('i');

        $this->files->put(
            $path,
            $this->sortImports(
                $this->buildServiceClass($name, $hasInterface)
            )
        );
        $message = $this->type;

        // If the option for interface exists
        if ($hasInterface) {
            $interfaceName = $this->getNameInput() . 'Interface.php';
            $interfacePath = str_replace($this->getNameInput() . '.php', 'Interfaces/', $path);

            $this->makeDirectory($interfacePath . $interfaceName);

            $this->files->put(
                $interfacePath . $interfaceName,
                $this->sortImports(
                    $this->buildServiceInterface($this->getNameInput())
                )
            );

            $message .= ' and Interface';
        }

        $this->info($message . ' created successfully.');
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     * @param $hasInterface
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildServiceClass(string $name, $hasInterface): string
    {
        $stub = $this->files->get(
            $hasInterface ? $this->getServiceInterfaceStub() : $this->getStub()
        );

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildServiceInterface(string $name): string
    {
        $stub = $this->files->get($this->getInterfaceStub());

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * @param $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Services';
    }
}