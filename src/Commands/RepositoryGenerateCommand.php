<?php namespace Kifed\Generator\Commands;


use Illuminate\Console\Command;

class RepositoryGenerateCommand extends Command {

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
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
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