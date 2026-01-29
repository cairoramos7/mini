<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeControllerCommand extends Command
{
    protected static $defaultName = 'make:controller';

    protected function configure()
    {
        $this
            ->setDescription('Creates a new controller class')
            ->setHelp('This command allows you to create a user controller')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the controller');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        
        // Ensure the name ends with "Controller"
        if (!str_ends_with($name, 'Controller')) {
            $name .= 'Controller';
        }

        $filename = $name . '.php';
        $path = __DIR__ . '/../../controllers/' . $filename; // Relative to App/Console/Commands/../../

        // Check if controller already exists
        if (file_exists($path)) {
            $output->writeln('<error>Controller already exists!</error>');
            return Command::FAILURE;
        }

        // Template content
        $content = <<<PHP
<?php

class {$name} extends Controller {
    public function index() {
        // \$this->view('folder.file');
    }
}
PHP;

        // Create directory if it doesn't exist (though controllers dir should exist)
        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        // Write file
        if (file_put_contents($path, $content)) {
            $output->writeln('<info>Controller created successfully:</info> ' . $filename);
            return Command::SUCCESS;
        } else {
            $output->writeln('<error>Failed to create controller.</error>');
            return Command::FAILURE;
        }
    }
}
