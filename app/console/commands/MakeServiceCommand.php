<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeServiceCommand extends Command
{
    protected static $defaultName = 'make:service';

    protected function configure()
    {
        $this
            ->setDescription('Creates a new service class')
            ->setHelp('This command allows you to create a new service')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the service');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        
        if (!str_ends_with($name, 'Service')) {
            $name .= 'Service';
        }

        $filename = $name . '.php';
        $path = __DIR__ . '/../../services/' . $filename;

        if (file_exists($path)) {
            $output->writeln('<error>Service already exists!</error>');
            return Command::FAILURE;
        }

        $content = <<<PHP
<?php

namespace App\Services;

class {$name} {
    public function execute() {
        // ...
    }
}
PHP;

        // Ensure directory exists
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        if (file_put_contents($path, $content)) {
            $output->writeln('<info>Service created successfully:</info> ' . $filename);
            return Command::SUCCESS;
        } else {
            $output->writeln('<error>Failed to create service.</error>');
            return Command::FAILURE;
        }
    }
}
