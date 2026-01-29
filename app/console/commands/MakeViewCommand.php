<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeViewCommand extends Command
{
    protected static $defaultName = 'make:view';

    protected function configure()
    {
        $this
            ->setDescription('Creates a new Blade view file')
            ->setHelp('This command allows you to create a new view. Use dot notation for subdirectories.')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the view (e.g., folder.file)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        
        // Convert dot notation to path
        $pathParts = explode('.', $name);
        $fileName = array_pop($pathParts) . '.blade.php';
        $dirPath = implode('/', $pathParts);
        
        $baseDir = __DIR__ . '/../../views/';
        $fullDirPath = $baseDir . $dirPath;
        $fullPath = $fullDirPath . (empty($dirPath) ? '' : '/') . $fileName;

        if (file_exists($fullPath)) {
            $output->writeln('<error>View already exists!</error>');
            return Command::FAILURE;
        }

        $content = <<<HTML
@extends('layout')

@section('title', 'Title Here')

@section('content')
    <h1>Hello World</h1>
@endsection
HTML;

        if (!is_dir($fullDirPath)) {
            mkdir($fullDirPath, 0777, true);
        }

        if (file_put_contents($fullPath, $content)) {
            $output->writeln('<info>View created successfully:</info> ' . $name);
            return Command::SUCCESS;
        } else {
            $output->writeln('<error>Failed to create view.</error>');
            return Command::FAILURE;
        }
    }
}
