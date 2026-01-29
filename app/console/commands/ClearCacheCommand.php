<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ClearCacheCommand extends Command
{
    protected static $defaultName = 'clear:cache';

    protected function configure()
    {
        $this
            ->setDescription('Clears the application cache (Blade views)')
            ->setHelp('This command clears the compiled Blade views from storage/views/cache');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $cacheDir = __DIR__ . '/../../../storage/views/cache';

        if (!is_dir($cacheDir)) {
            $io->success('Cache directory does not exist, nothing to clear.');
            return Command::SUCCESS;
        }

        $files = glob($cacheDir . '/*');
        $count = 0;

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
                $count++;
            }
        }

        $io->success("Cache cleared successfully! Removed {$count} files.");
        return Command::SUCCESS;
    }
}
