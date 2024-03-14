<?php

namespace nailfor\Couchbase\Couch;

use Illuminate\Support\Arr;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Processors\Processor as BaseProcessor;

class Processor extends BaseProcessor
{
    public function processSelect(Builder $query, $results)
    {
        return $results;
    }
}
