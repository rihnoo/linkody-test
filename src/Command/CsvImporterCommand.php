<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;
use App\Service\PageCsvImporter;

#[AsCommand(
    name: 'csv:importer',
    description: 'import csv file and populate to db',
)]
class CsvImporterCommand extends Command
{
    private PageCsvImporter $csvImporter;

    public function __construct(PageCsvImporter $csvImporter)
    {
        $this->csvImporter = $csvImporter;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filename = $io->ask('Input CSV File name:', 'url.csv');

        $finder = new Finder();
        $finder->files()->in('public/resources')->name($filename);

        if (!$finder->hasResults()) {
            $io->error('File does not exist!');
            return Command::FAILURE;
        }

        $absoluteFilePath = false;
        $extension = '';

        foreach ($finder as $file) {
            $absoluteFilePath = $file->getRealPath();
            $extension = $file->getExtension();
        }

        if (!$absoluteFilePath || $extension != 'csv') {
            $io->error('Invalid File!');
            return Command::FAILURE;
        }

        $this->csvImporter->import($absoluteFilePath);

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
