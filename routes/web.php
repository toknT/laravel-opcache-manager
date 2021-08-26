<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('opcache-manager-refresh-trigger', function (Request $request) {
    $result = opcache_reset() ? 'success' : 'fail';
    return response()->json($result);
})->name('opcache.refresh.trigger')->middleware('signed');
