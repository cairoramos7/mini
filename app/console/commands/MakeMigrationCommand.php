<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeMigrationCommand extends Command
{
    protected static $defaultName = 'make:migration';

    protected function configure()
    {
        $this
            ->setDescription('Creates a new database migration')
            ->setHelp('This command creates a new migration file using Phinx')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the migration (e.g. CreateUsersTable)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        
        // Ensure name is StudlyCase for good measure, though Phinx allows standard strings
        // Just calling phinx create logic
        
        $phinxBin = __DIR__ . '/../../../vendor/bin/phinx';
        
        if (!file_exists($phinxBin)) {
            $output->writeln('<error>Phinx binary not found!</error>');
            return Command::FAILURE;
        }

        // We can't easily rely on passthru inside here if we want to keep control or input,
        // but for a simple command it's fine.
        // However, better to execute via shell to ensure environment context if needed.
        
        $command = "{$phinxBin} create {$name}";
        
        passthru($command, $returnVar);

        if ($returnVar === 0) {
            return Command::SUCCESS;
        } else {
            return Command::FAILURE;
        }
    }
}
