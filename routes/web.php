<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontalController@index')->name('front_index');
Route::get('/downloads', 'FrontalController@download')->name('front_download');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(array('prefix' => 'workcharts'), function() {
    Route::get('/', 'WorkChartController@index')->name('workcharts');
    Route::get('create', 'WorkChartController@create')->name('workcharts.create');
    Route::post('create', 'WorkChartController@store')->name('workcharts.store');
    Route::get('{id}/edit', 'WorkChartController@edit')->name('workcharts.edit');
    Route::put('{id}/update', 'WorkChartController@update')->name('workcharts.update');
    Route::get('{id}', 'WorkChartController@show')->name('workcharts.show');
	Route::get('delete/{workchart_id}', 'WorkChartController@workchartdelete')->name('workcharts.delete');
});

Route::group(array('prefix' => 'intervals'), function() {
    Route::get('/', 'IntervalController@index')->name('intervals');
    Route::get('create', 'IntervalController@create')->name('intervals.create');
    Route::post('create', 'IntervalController@store')->name('intervals.store');
    Route::get('{id}/edit', 'IntervalController@edit')->name('intervals.edit');
    Route::put('{id}/update', 'IntervalController@update')->name('intervals.update');
    Route::get('{id}', 'IntervalController@show')->name('intervals.show');
    Route::get('delete/{id}', 'IntervalController@destroy')->name('intervals.destroy');
});

Route::group(array('prefix' => 'algos'), function() {
    Route::get('/', 'AlgoController@index')->name('algos');
    Route::get('create', 'AlgoController@create')->name('algos.create');
    Route::post('create', 'AlgoController@store')->name('algos.store');
    Route::get('{id}/edit', 'AlgoController@edit')->name('algos.edit');
    Route::put('{id}/update', 'AlgoController@update')->name('algos.update');
    Route::get('{id}', 'AlgoController@show')->name('algos.show');
    Route::get('delete/{id}', 'AlgoController@destroy')->name('algos.destroy');
});

Route::group(array('prefix' => 'charts'), function() {
    Route::get('/{id}', 'ChartController@index')->name('charts');
    Route::get('{id}/create', 'ChartController@create')->name('charts.show');
    Route::post('create', 'ChartController@store')->name('charts.store');
    Route::get('{id}/edit', 'ChartController@edit')->name('charts.edit');
    Route::put('update/{id}', 'ChartController@update')->name('charts.update');
    //Route::get('{id}', 'ChartController@show')->name('charts.show');
    Route::get('view/{id}', 'ChartController@showchart')->name('charts.show');
    Route::get('get_timeseries_form/{id}', 'ChartController@getTimeseriesForm');
    Route::get('delete_time_series/{id}', 'ChartController@deleteTimeseries');
	Route::get('delete/{id}', 'ChartController@chartdelete')->name('charts.delete');
    Route::get('deleteParent/{id}', 'ChartController@deleteParent');
    Route::get('deletesignal/{chartid}/{level}', 'ChartController@deletesignal');
    Route::get('getCreateChart/{id}', 'ChartController@getCreateChart');
    Route::post('/addsignal', 'ChartController@addsignal');
    Route::get('getChartSignal/{id}', 'ChartController@getChartSignal');
    Route::get('/getSignalForm/{id}/{level}/{value}', 'ChartController@getSignalForm');

    Route::post('/saveChartLine', 'ChartController@saveChartLine');
    Route::get('/getChartLine/{id}', 'ChartController@getChartLine');

    Route::post('add_comment/{id}', 'ChartController@addComment');
    Route::post('get_comments/{id}', 'ChartController@getComments');
    Route::post('get_comment/{id}', 'ChartController@getComment');
    Route::post('delete_comment', 'ChartController@deleteComment');
    Route::post('delete_line', 'ChartController@deleteLine');
    Route::post('delete_signal', 'ChartController@deleteSignalLevel');

    Route::post('getMicroTimeDate', 'ChartController@getMicroTimeDate');

    //get all chart list of work chart
    Route::get('workchart_charts_list/{id}', 'ChartController@workchart_charts_list');
    Route::post('saveGroupChart', 'ChartController@saveGroupChart');

});
