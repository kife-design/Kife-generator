<?php namespace Kifed\Generator;

use Illuminate\Support\ServiceProvider;

class GeneratorServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/kifegen.php' => config_path('kifegen.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->generateRepositoryCommand();
        $this->generateContractCommand();
        $this->generateResourceCommand();

        $this->mergeConfigFrom(__DIR__.'/config/kifegen.php', 'kifegen');
    }

    private function generateRepositoryCommand()
    {
        $this->app->singleton('command.kifed.repository', function ($app) {
            return $app['Kifed\Generator\Commands\RepositoryGenerateCommand'];
        });

        $this->commands('command.kifed.repository');
    }

    private function generateContractCommand()
    {
        $this->app->singleton('command.kifed.contract', function ($app) {
            return $app['Kifed\Generator\Commands\ContractGenerateCommand'];
        });

        $this->commands('command.kifed.contract');
    }


    private function generateResourceCommand()
    {
        $this->app->singleton('command.kifed.resource', function ($app) {
            return $app['Kifed\Generator\Commands\ResourceGenerateCommand'];
        });

        $this->commands('command.kifed.resource');
    }
}
