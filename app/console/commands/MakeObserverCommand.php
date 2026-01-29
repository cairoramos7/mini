<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeObserverCommand extends Command
{
    protected static $defaultName = 'make:observer';

    protected function configure()
    {
        $this
            ->setDescription('Creates a new observer class')
            ->setHelp('This command allows you to create a new observer')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the observer');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        
        if (!str_ends_with($name, 'Observer')) {
            $name .= 'Observer';
        }

        $filename = $name . '.php';
        $path = __DIR__ . '/../../observers/' . $filename;

        if (file_exists($path)) {
            $output->writeln('<error>Observer already exists!</error>');
            return Command::FAILURE;
        }

        $content = <<<PHP
<?php

namespace App\Observers;

class {$name} {
    public function update(\$subject) {
        // ...
    }
}
PHP;

        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        if (file_put_contents($path, $content)) {
            $output->writeln('<info>Observer created successfully:</info> ' . $filename);
            return Command::SUCCESS;
        } else {
            $output->writeln('<error>Failed to create observer.</error>');
            return Command::FAILURE;
        }
    }
}
