<?php namespace Kifed\Generator\Commands;


use Symfony\Component\Console\Input\InputArgument;

class InterfaceGenerateCommand extends GeneratorCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:interface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository interface.';

    /**
     * Parse the name and format according to the root namespace.
     *
     * @param  string $name
     * @return string
     */
    protected function parseName($name)
    {
        return ucwords(camel_case($name)) . 'Repository';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../stubs/repository-interface.stub';
    }
    /**
     * Get the destination class path.
     *
     * @param  string $name
     * @return string
     */
    protected function getPath($name)
    {
        return './database/seeds/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the interface'],
        ];
    }


    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}