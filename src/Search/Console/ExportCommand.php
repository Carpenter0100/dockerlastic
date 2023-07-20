<?php

declare(strict_types=1);

namespace Simovative\Dockerlastic\Search\Console;

use Elastic\Elasticsearch\ClientBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ExportCommand extends Command
{
    private const NAME = 'app:export';

    public function __construct() {
        parent::__construct(self::NAME);
        $this->setDescription('Search');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('=== Export ===');

        $client = ClientBuilder::create()
            ->setHosts(['elasticsearch:9200'])
            ->build();

        $client->index(
            [
                'index' => 'article',
                'id'    => '1',
                'body'  => [
                    'text' => 'Dies ist mein Text.',
                    'author' => 'Hans Meier',
                ]
            ]
        );

        $client->index(
            [
                'index' => 'article',
                'id'    => '2',
                'body'  => [
                    'text' => 'Dies ist mein zweiter Text.',
                    'author' => 'Hans Dieter',
                ]
            ]
        );

        return Command::SUCCESS;
    }
}
