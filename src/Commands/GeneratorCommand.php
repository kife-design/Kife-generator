<?php namespace Kifed\Generator\Commands;

use Illuminate\Console\GeneratorCommand as Command;

abstract class GeneratorCommand extends Command {

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$name = $this->formatName($this->getNameInput());

		if ( $this->files->exists($path = $this->getPath($name)) )
		{
			return $this->error($this->type . ' already exists!');
		}

		$this->makeDirectory($path);

		$this->files->put($path, $this->buildClass($this->parseName($name)));

		$this->info($this->type . ' created successfully.');
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
		$rootNamespace = $this->getAppNamespace();

		if ( starts_with($name, $rootNamespace) )
		{
			return $name;
		}

		if ( str_contains($this->getConfigPath(), '/') )
		{
			$namespace = str_replace('/', '\\', $this->getConfigPath());
		}

		return $this->parseName($this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $namespace . $name);
	}


	/**
	 * Get the destination class path.
	 *
	 * @param  string $name
	 *
	 * @return string
	 */
	protected function getPath($name)
	{
		return $this->laravel['path'] . '/' . $this->getConfigPath() . str_replace('\\', '/', $name) . '.php';
	}


	/**
	 * Format the name according to the settings that were defined in the config
	 *
	 * @param      $name
	 *
	 * @param null $type
	 *
	 * @return mixed
	 */
	protected function formatName($name, $type = null)
	{
		return str_replace('{{name}}', $name, $this->getConfigName($type));
	}


	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		if ( config('kifegen.' . $this->type . '_stub') )
		{
			return base_path() . '/' . config('kifegen.' . $this->type . '_stub');
		}

		return $this->getFallbackStub();
	}


	/**
	 * Build the class with the given name.
	 *
	 * @param  string $name
	 *
	 * @return string
	 */
	protected function buildClass($name)
	{
		$stub = $this->files->get($this->getStub());

		return $this->replaceNamespace($stub, $name)->replaceSmartnames($stub);
	}


	public function replaceSmartnames($stub)
	{
		$stub = str_replace('{{class}}', $this->formatName($this->getNameInput()), $stub);

		return str_replace('{{interface}}', $this->formatName($this->getNameInput(), 'contract'), $stub);
	}


	/**
	 * Get the default stub in case none was defined in the config
	 *
	 * @return string
	 */
	protected function getFallbackStub()
	{
		return __DIR__ . '/../stubs/repository-' . $this->type . '.stub';
	}


	/**
	 * Return the path config for the matching type
	 *
	 * @return mixed
	 */
	protected function getConfigPath()
	{
		$path = explode("/", config('kifegen.' . $this->type . '_path'));
		unset( $path[0] );

		return implode("/", $path);
	}


	/**
	 * Return the name config for the matching type
	 *
	 * @param null $type
	 *
	 * @return mixed
	 */
	protected function getConfigName($type = null)
	{
		if ( is_null($type) )
		{
			$type = $this->type;
		}

		return config('kifegen.' . $type . '_name');
	}


	protected function getConfigStub()
	{
		return config('kifegen.' . $this->type . '_stub');
	}
}