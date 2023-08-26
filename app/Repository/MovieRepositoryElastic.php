<?php

namespace App\Repository;

use Demo\Domain\Entity\Movie;
use Demo\Domain\Repository\MovieRepository;
use Elastic\Elasticsearch\ClientInterface;
use Elastic\Elasticsearch\Exception\ClientResponseException;

class MovieRepositoryElastic implements MovieRepository
{
    public function __construct(private ClientInterface $client)
    {
    }

    public function createIndex(): void
    {
        try {
            $this->client->indices()->getSettings(['index' => 'movies']);
        } catch (ClientResponseException $responseException) {
            $status = $responseException->getCode();
            if ($status !== 404) {
                throw $responseException;
            }
        }

        $params = [
            'index' => 'movies',
            'body' => [
                'settings' => [
                    'number_of_shards' => 1,
                    'number_of_replicas' => 1
                ]
            ]
        ];

        $this->client->indices()->create($params);
    }

    public function update(Movie $movie): void
    {
        $params = [
            'index' => 'movies',
            'body'  => [ 'title' => 'title2', 'genre' => 'genre value2']
        ];

        $response = $this->client->index($params);
    }

    public function delete(int $id): void
    {
    }

    public function getByParams(array $params): array
    {
        $params = [
            'index' => 'movies',
        ];

        $results = $this->client->search($params);

        $milliseconds = $results['took'];
        $maxScore     = $results['hits']['max_score'];

        $score = $results['hits']['hits'][0]['_score'];
        $doc   = $results['hits']['hits'][0]['_source'];

        var_dump($results['hits']['hits']); die;


        var_dump($milliseconds, $maxScore, $score, $doc); die;
    }
}
