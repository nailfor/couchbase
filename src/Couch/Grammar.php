<?php

namespace nailfor\Couchbase\Couch;

use nailfor\Couchbase\Query\QueryBuilder;

use Illuminate\Database\Query\Grammars\Grammar as BaseGrammar;

class Grammar extends BaseGrammar
{
    protected function wrapValue($value)
    {
        if ($value !== '*') {
            return str_replace('"', '""', $value);
        }

        return $value;
    }    
}
