<?php namespace Kifed\Generator\Commands;

use Illuminate\Console\AppNamespaceDetectorTrait;
use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class ResourceGenerateCommand extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:resource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository with its implementation.';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->createModel();
        $this->createContract();
        $this->createImplementation();
    }


    protected function createModel()
    {
        if ($this->option('name')) {
            $this->call('make:model', [
                'name' => $this->argument('name'),
                '--no-migration' => true
            ]);
        }
    }


    protected function createContract()
    {
        if ($this->argument('name')) {
            $this->call('generate:interface', [
                'name' => $this->argument('name')
            ]);
        }
    }


    protected function createImplementation()
    {
        if ($this->argument('name')) {
            $this->call('generate:repository', [
                'name' => $this->argument('name')
            ]);
        }
    }


    /**
     * Parse the name and format according to the root namespace.
     *
     * @param  string $name
     *
     * @return string
     */
    protected function parseName($name)
    {
        return ucwords(camel_case($name));
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            [ 'name', InputArgument::REQUIRED, 'The name of the implementation' ],
        ];
    }


    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [ ];
    }


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        // TODO: Implement getStub() method.
    }
}
