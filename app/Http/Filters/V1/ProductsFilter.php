<?php

namespace App\Http\Filters\V1;

use Illuminate\Http\Request;
use App\Http\Filters\ApiFilter;

class ProductsFilter extends ApiFilter{

    protected $safeParms = [
    'name' => ['eq'],
    'categore_id' => ['eq'],
    ];
    protected $columnMap = [];
    protected $operatorMap = [
    'eq' => '=',
    'lt' => '<',
    'lte' => '=<',
    'gt' => '>',
    'gte' => '=>',
    ];
}
