<?php

namespace nailfor\Couchbase;

use nailfor\Couchbase\Couch\Grammar;
use nailfor\Couchbase\Couch\Processor;
use nailfor\Couchbase\Query\QueryBuilder;
use Illuminate\Database\Connection as BaseConnection;

class Connection extends BaseConnection
{
    /**
     * @inheritdoc
     */
    public function query()
    {
        return new QueryBuilder(
            $this, 
            new Grammar,
            new Processor,
        );
    }

    public function select($query, $bindings = [], $useReadPdo = true)
    {
        return $this->run($query, $bindings, function ($query, $bindings) use ($useReadPdo) {
            if ($this->pretending()) {
                return [];
            }

            // For select statements, we'll simply execute the query and return an array
            // of the database result set. Each element in the array will be a single
            // row from the database table, and will either be an array or objects.
            $pdo = $this->getPdoForSelect($useReadPdo);
            $statement = $pdo->prepare($query);
    
            $this->bindValues($statement, $this->prepareBindings($bindings));

            $statement->execute();

            return $statement->fetchAll();
        });
    }
}
