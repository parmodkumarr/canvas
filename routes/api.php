<?php
use Illuminate\Http\Request;
use App\User;
use App\Article;
use App\Workchart;
use App\Workarea;
use App\Chart;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/auth/register', 'Auth\RegisterController@register');
Route::post('/auth/login', 'Auth\LoginController@login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users', function () {
    return User::all();
});

/*
 * articles routes
 */
Route::get('/articles', function () {
    return Article::paginate(50);
});
Route::get('/articles/{id}', function ($id) {
    return Article::findOrFail($id);
});
Route::put('/articles/{id}', function ($id, Request $request) {
    $article = Article::findOrFail($id);
    $article->title = $request->get('title');
    $article->slug = $request->get('slug');
    $article->content = $request->get('content');
    $article->save();
    return response('Article Updated!', 200);
});
Route::delete('/articles/{id}', function ($id) {
    $article = Article::findOrFail($id);
    $article->delete();
    return response('Article Deleted.', 200);
});

/*
 * workcharts routes
 */
 Route::post('/workarea/add', function (Request $request) {

    $workarea = new Workarea;
    $workarea->workchart_id = $request->get('workchart_id');
    $workarea->save();

    foreach ($request->get('charts') as $key => $item) {
      $chart = new Chart;
      $chart->workarea_id = $workarea->id;
      $chart->type = $item['type'];
      $chart->color = $item['color'];
      $chart->position = $item['position'];
      $chart->save();
    }

    $response['message'] = 'Charts add successfully!';
    $response['status'] = 'success';

    return response($response, 200);

 });
// Route::get('/workcharts/add', function (Request $request) {
//     workchart = new Workchart;
//     workchart->title = $request->get('title');
//     workchart->save();
//     return response('workchart created!', 200);
// });
// Route::put('/workcharts/{id}', function ($id, Request $request) {
//     workchart = Workchart::findOrFail($id);
//     workchart->title = $request->get('title');
//     workchart->save();
//     return response('workchart Updated!', 200);
// });
// Route::delete('/workcharts/{id}', function ($id) {
//     $article = Workchart::findOrFail($id);
//     $article->delete();
//     return response('Workchart Deleted.', 200);
// });
