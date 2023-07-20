<?php

declare(strict_types=1);

namespace Simovative\Dockerlastic\Search\Console;

use Elastic\Elasticsearch\ClientBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SearchCommand extends Command
{
    private const NAME = 'app:search';

    public function __construct() {
        parent::__construct(self::NAME);
        $this->setDescription('Search');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('=== Search ===');

        $client = ClientBuilder::create()
            ->setHosts(['elasticsearch:9200'])
            ->build();

        $result = $client->search(
            [
                'index' => 'article',
                'body'  => [
                    'query' => [
                        'match' => [
                            'author' => 'Dieter'
                        ]
                    ]
                ]
            ]
        );

        $output->writeln((string) $result->getBody());

        return Command::SUCCESS;
    }
}
