<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeListenerCommand extends Command
{
    protected static $defaultName = 'make:listener';

    protected function configure()
    {
        $this
            ->setDescription('Creates a new listener class')
            ->setHelp('This command allows you to create a new listener')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the listener');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        
        if (!str_ends_with($name, 'Listener')) {
            $name .= 'Listener';
        }

        $filename = $name . '.php';
        $path = __DIR__ . '/../../listeners/' . $filename;

        if (file_exists($path)) {
            $output->writeln('<error>Listener already exists!</error>');
            return Command::FAILURE;
        }

        $content = <<<PHP
<?php

namespace App\Listeners;

class {$name} {
    public function handle(\$event) {
        // ...
    }
}
PHP;

        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        if (file_put_contents($path, $content)) {
            $output->writeln('<info>Listener created successfully:</info> ' . $filename);
            return Command::SUCCESS;
        } else {
            $output->writeln('<error>Failed to create listener.</error>');
            return Command::FAILURE;
        }
    }
}
