<?php

namespace Rinvi\Agent;

use Illuminate\Support\ServiceProvider;

class AgentServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     */
    public function boot()
    {

        $this->publishMigrations();
    }

    public function register()
    {
        $this->app->singleton('agent', function ($app) {
            return new Agent($app['request']->server());
        });

        $this->app->alias('agent', Agent::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['agent', Agent::class];
    }

    protected function publishMigrations()
    {
        if (!class_exists('CreateGSuiteConfigurationsTable')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__ . '/../database/migrations/tenant/create_g_suite_configurations_table.php.stub' => $this->app->databasePath() . "/migrations/tenant/{$timestamp}_create_g_suite_configurations_table.php",
            ]);
        }
    }
}
