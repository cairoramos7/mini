<?php

namespace App\Console;

use Symfony\Component\Console\Application;

class Kernel
{
    protected $commands = [
        \App\Console\Commands\MakeControllerCommand::class,
        \App\Console\Commands\MakeModelCommand::class,
        \App\Console\Commands\MakeServiceCommand::class,
        \App\Console\Commands\MakeObserverCommand::class,
        \App\Console\Commands\MakeListenerCommand::class,
        \App\Console\Commands\MakeViewCommand::class,
        \App\Console\Commands\MakeMigrationCommand::class,
        \App\Console\Commands\ClearCacheCommand::class,
    ];

    public function handle()
    {
        $application = new Application('Mini Framework', '1.0.0');

        foreach ($this->commands as $command) {
            $application->add(new $command());
        }

        // Add default Phinx commands here or via Phinx integration
        // For now, let's keep it simple and register our own commands

        $application->run();
    }
}
