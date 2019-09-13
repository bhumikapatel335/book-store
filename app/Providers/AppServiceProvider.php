<?php

namespace App\Providers;

use App\Entities\Book;
use App\Repostiories\BookRepository;
use App\Repostiories\DoctorineBookRepository;
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
        $repositoryMap = config('doctrine.repositories.map');

        foreach ($repositoryMap as $entityClass => $repositoryClass) {
            $this->app->bind($repositoryClass, function($app) use ($entityClass, $repositoryClass) {
                return new $repositoryClass($app['em'], $app['em']->getClassMetadata($entityClass));
            });
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
