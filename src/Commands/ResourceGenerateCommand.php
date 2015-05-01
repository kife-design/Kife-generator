<?php namespace Kifed\Generator\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ResourceGenerateCommand extends Command {

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
		if ( ! $this->option('no-model') )
		{
			$this->createModel();
		}

		$this->createContract();
		$this->createImplementation();
	}


	protected function createModel()
	{
		if ( $this->argument('name') )
		{
			$this->call('make:model', [
				'name'           => $this->argument('name'),
				'--no-migration' => true
			]);
		}
	}


	protected function createContract()
	{
		if ( $this->argument('name') )
		{
			$this->call('generate:contract', [
				'name' => $this->argument('name')
			]);
		}
	}


	protected function createImplementation()
	{
		if ( $this->argument('name') )
		{
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
			['name',InputArgument::REQUIRED,'The name of the implementation'],
		];
	}


	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['no-model', null, InputOption::VALUE_NONE, 'Do not create a model' ]
		];
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
