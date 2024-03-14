<?php

namespace nailfor\Couchbase\Eloquent;

use nailfor\Couchbase\Query\QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class Builder extends EloquentBuilder
{
    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
    }
}
