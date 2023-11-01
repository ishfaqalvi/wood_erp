<?php

use App\Models\Bank;
use App\Models\Account;

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function banks()
{
    return Bank::pluck('title','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function accounts()
{
    return Account::pluck('title','id');
}