<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeModelCommand extends Command
{
    protected static $defaultName = 'make:model';

    protected function configure()
    {
        $this
            ->setDescription('Creates a new model class')
            ->setHelp('This command allows you to create a new model')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the model');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        
        if (!str_ends_with($name, 'Model')) {
            $name .= 'Model';
        }

        $filename = $name . '.php';
        $path = __DIR__ . '/../../models/' . $filename;

        if (file_exists($path)) {
            $output->writeln('<error>Model already exists!</error>');
            return Command::FAILURE;
        }

        // Simplistic pluralization for table name guessing (educational purpose)
        $tableName = strtolower(str_replace('Model', '', $name)) . 's';

        $content = <<<PHP
<?php

class {$name} extends Model {
    public \$table = "{$tableName}";
    protected \$fillable = [
        // 'column1', 'column2'
    ];
}
PHP;

        if (file_put_contents($path, $content)) {
            $output->writeln('<info>Model created successfully:</info> ' . $filename);
            return Command::SUCCESS;
        } else {
            $output->writeln('<error>Failed to create model.</error>');
            return Command::FAILURE;
        }
    }
}
