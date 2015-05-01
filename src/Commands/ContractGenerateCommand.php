<?php namespace Kifed\Generator\Commands;

use Symfony\Component\Console\Input\InputArgument;

class ContractGenerateCommand extends GeneratorCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'generate:contract';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new repository contract.';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'contract';


	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			[
				'name',
				InputArgument::REQUIRED,
				'The name of the contract'
			],
		];
	}
}