<?php

namespace App\Providers;

use App\Repository\MovieRepositoryElastic;
use Demo\Domain\Repository\MovieRepository;
use Elastic\Elasticsearch\ClientBuilder;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(MovieRepository::class, function ($app) {
            $client = ClientBuilder::create()->setHosts(['elasticsearchdemo-es01:9200'])->build();
            return new MovieRepositoryElastic($client);
        });
    }
}
