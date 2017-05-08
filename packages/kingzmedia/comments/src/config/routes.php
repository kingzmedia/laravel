<?php
/*Route::get('top/{type}/today',
    'Kingzmedia\Views\Controllers\ViewsController@top', 'top_today');
*/

Route::group([
    'middleware' => 'web',
    'prefix' => 'api/v1/comments/',
    'namespace' => 'Kingzmedia\Comments\Controllers'
], function() {
    Route::get('{model}/{model_id}',
        'ApiController@show')->where('model_id', '[0-9]+')->name('api_comments_show');
});