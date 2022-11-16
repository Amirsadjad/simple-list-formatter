<?php

namespace Amirsadjad\SimpleListFormatter\Facades;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Amirsadjad\SimpleListFormatter\Classes\SimpleListFormatter Of($data, $preset)
 * @method static \Amirsadjad\SimpleListFormatter\Classes\SimpleListFormatter dataType()
 *
 */

class SimpleList extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'SimpleListFormatter';
    }
}
