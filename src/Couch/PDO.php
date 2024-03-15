<?php

namespace nailfor\Couchbase\Couch;

use Couchbase\Cluster;
use Couchbase\ClusterOptions;
use Couchbase\QueryOptions;

class PDO
{
    protected Cluster $client;

    protected string $query;

    protected array $bindings = [];

    public function __construct($dsn, $username, $password, $options)
    {
        $options = new ClusterOptions();
        $options->credentials(
            $username,
            $password
        );
        $options->connectTimeout(1000);
        $options->bootstrapTimeout(1000);

        $this->client = new Cluster($dsn, $options);
    }

    public function prepare(string $query): self
    {
        $this->query = $query;
        $this->bindings = [];

        return $this;
    }

    public function bindValue(string|int $param, mixed $value)
    {
        $this->bindings[$param] = $value;
    }
    
    public function execute(): void
    {
    }

    public function fetchAll(): ?array
    {
        $sql = $this->getSql();

        $queryOptions = new QueryOptions();
        $queryOptions->namedParameters([]);
        $result = $this->client->query($sql, $queryOptions);

        return $result->rows();
    }

    protected function getSql(): string
    {
        $wrapped_str = str_replace('?', "'?'", $this->query);

        return \Str::replaceArray('?', $this->bindings, $wrapped_str);
    }
}
