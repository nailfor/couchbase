<?php

namespace nailfor\Couchbase;

use Illuminate\Support\ServiceProvider;
use nailfor\Couchbase\Eloquent\Model;
use nailfor\Couchbase\Couch\PDOConnector;

class CouchbaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        Model::setConnectionResolver($this->app['db']);

        Model::setEventDispatcher($this->app['events']);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        // Add database driver.
        $this->app->resolving('db', fn ($db) => $db
            ->extend('couchbase', function ($config, $name) {
                $config['name'] = $name;
                $database = $config['bucket'] ?? '';

                $connector = new PDOConnector();
                $pdo = $connector->connect($config);
                
                return new Connection($pdo, $database, '', $config);
            })
        );
    }
}
