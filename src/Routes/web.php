<?php

use Amirsadjad\SimpleListFormatter\Http\Controllers\SimpleListFormatterPresetController;
use Illuminate\Support\Facades\Route;

Route::prefix(config('simple-list-formatter.route_prefix'))
    ->name(config('simple-list-formatter.route_prefix').'.')
    ->middleware(config('simple-list-formatter.presets_route_middleware'))
    ->group(function() {

        Route::get('', fn() => \Amirsadjad\SimpleListFormatter\Models\SimpleListPresets::find('test'));

        Route::resource('presets', SimpleListFormatterPresetController::class)
            ->except(array_merge(['create', 'edit'], config('simple-list-formatter.presets_methods_exclude')));

    });
