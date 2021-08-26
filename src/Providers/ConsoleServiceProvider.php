<?php

namespace Toknsit\LaravelOpcacheManager\Providers;

use Illuminate\Support\ServiceProvider;
use Toknsit\LaravelOpcacheManager\Console\ClearCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        // $this->registerCommands();
        if ($this->app->runningInConsole()) {
            $this->commands([
                ClearCommand::class,
            ]);
        }
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
    }

    public function register()
    {
        // register bindings
    }
}
