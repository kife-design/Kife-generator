<?php namespace Kifed\Generator\Commands;

use Symfony\Component\Console\Input\InputArgument;

class RepositoryGenerateCommand extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'repository';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
	{
		return __DIR__ . '/../stubs/repository-implementation.stub';
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
}