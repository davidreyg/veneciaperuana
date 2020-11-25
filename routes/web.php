<?php

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Storage;
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
    return view('app');
})->middleware('install');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/on-boarding', function () {
    return view('app');
})->name('install')->middleware('redirect-if-installed');

// Route::get('/test', function () {

    // var_dump(Storage::where('code', 'PROD-000003')->first());
    // return Invoice::with(['invoice_products.detailable'])->get();
    // $oldDatabaseConfiguration =
    //         "DB_CONNECTION=" . config("database.default") . "\n" .
    //         "DB_HOST=" . config("database.connections." . config("database.default") . ".host") . "\n" .
    //         "DB_PORT=" . config("database.connections." . config("database.default") . ".port") . "\n" .
    //         "DB_DATABASE=" . config("database.connections." . config("database.default") . ".database") . "\n" .
    //         "DB_USERNAME=" . config("database.connections." . config("database.default") . ".username") . "\n" .
    //         "DB_PASSWORD='" . config("database.connections." . config("database.default") . ".password") . "'\n";

    //     $newDatabaseConfiguration =
    //         'DB_CONNECTION=' . 'hola mundo ctm' . "\n" ;
    //         // 'DB_HOST=' . $request->database_hostname . "\n" .
    //         // 'DB_PORT=' . $request->database_port . "\n" .
    //         // 'DB_DATABASE=' . $request->database_name . "\n" .
    //         // 'DB_USERNAME=' . $request->database_username . "\n" .
    //         // 'DB_PASSWORD="' . $request->database_password . "\"\n\n";

    //         file_put_contents(base_path('.env'), str_replace(
    //             $oldDatabaseConfiguration,
    //             $newDatabaseConfiguration,
    //             file_get_contents(base_path('.env'))
    //         ));
// });

// Route::get('/{vue?}', function () {
//     return view('app');
// })->where('vue', '[\/\w\.-]*')->name('home')->middleware('install');
