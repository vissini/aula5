<?php
use Illuminate\Http\Request;
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
Route::get('callback', function(Request $request){
    $code = $request->get('code');
   $http = new \GuzzleHttp\Client();
   $response = $http->post('http://localhost:8000/oauth/token', [
      'form_params' => [
          'client_id' => '3',
          'client_secret' => 'ZXwqEg0ddi29sgmucAzwcH5fUoxq6FkZPTZYfkE6', //é o nosso secret, gerado qdo criamos o acesso
          'redirect_uri' => 'http://localhost:9999/callback', //Ele vai comparar, se for diferente retorna um erro
          'code' => $code, //O código retornado da solicitação de autorização
          'grant_type' => 'authorization_code' //O tipo de autorização que estamos trabalhando. Temos outros tipos (password, client etc)
      ]
   ]);
   dd(json_decode($response->getBody(), true));
  });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function () {
    $query = http_build_query([
        'client_id' => '3',
        'redirect_uri' => 'http://localhost:9999/callback',
        'response_type' => 'code',
        'scope' => ''
      ]);
      return redirect("http://localhost:8000/oauth/authorize?$query");
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
