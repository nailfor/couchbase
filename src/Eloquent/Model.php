<?php

namespace nailfor\Couchbase\Eloquent;

use Illuminate\Database\Eloquent\Model as BaseModel;
use nailfor\Couchbase\Query\QueryBuilder;

/**
 * Elasticsearch.
 *
 */
class Model extends BaseModel
{
    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'couchbase';

    protected $primaryKey = '_id';

    public function newEloquentBuilder($query): Builder
    {
        /** @var QueryBuilder $query*/
        return new Builder($query);
    }

    protected function newRelatedInstance($class)
    {
        return new $class;
    }    
}