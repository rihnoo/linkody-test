<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use App\Entity\Page;

class PageCsvImporter
{
    private EntityManager $entityManager;
    private LoggerInterface $logger;

    public function __construct(EntityManager $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    public function import(String $filename): void
    {
        // To parse the csv file that contains more than 1 million lines, my approach is to use Generator
        $generator = $this->readCSV($filename);

        try {
            foreach ($generator as $item) {
                $page = new Page();
                $page->setUrl($item['URL']);

                $this->entityManager->persist($page);
                $this->entityManager->flush();
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }

    public function readCSV(String $filename, String $delimiter =','): \Generator
    {
        $header = [];
        $row = 0;
        $handle = fopen($filename, "r");

        if ($handle === false) {
            return;
        }

        while (($data = fgetcsv($handle, 0, $delimiter)) !== false) {
            if (0 == $row) {
                $header = $data;
            } else {
                yield array_combine($header, $data);
            }

            $row++;
        }
        fclose($handle);
    }
}
