<?php

namespace Amirsadjad\SimpleListFormatter\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class SimpleListPresets extends Model
{
    protected $table = 'simple_list_formatter_presets';
    protected $primaryKey = 'name';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['name', 'data'];
    protected $casts = [
        'data' => 'array'
    ];
}
