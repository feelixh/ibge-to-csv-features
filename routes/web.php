<?php

use App\Http\Controllers\ImportDataController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $response = Http::get('https://brasil.io/api/dataset/covid19/caso/data/?format=json&is_last=True&state=RS'); //com isso tenho cidades, população, óbitos, confirmados
    dd($response->json(['results']));
});



Route::get('import-idh',[ImportDataController::class, 'importIdhToDB']);
Route::get('import-ibge',[ImportDataController::class, 'importIbgeFileToDB']);
Route::get('import-isolated',[ImportDataController::class, 'importIsolateDataToDB']);
Route::get('import-covid-data',[ImportDataController::class, 'importCovidaDataToDB']);

