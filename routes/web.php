<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
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
    // $user = User::all();
    // dd($user);
    // Cache::store('file')->put('user',  $user, 600);\
    $now = Carbon::now();
    echo "Carbon::now() =" . $now;                               // 2022-12-31 15:56:18
    echo "\n<br/>";
    $today = Carbon::today();
    echo "Carbon::today() =" . $today;                             // 2022-12-31 00:00:00
    echo "\n<br/>";
    $tomorrow = Carbon::tomorrow();
    echo "Carbon::tomorrow() =" . $tomorrow;                          // 2023-01-01 00:00:00
    echo "\n<br/>";
    $yesterday = Carbon::yesterday();
    echo "Carbon::tomorrow() =" . $yesterday;
    echo "\n<br/>";    echo "\n<br/>";

    echo "Carbon::now()->startOfMonth() =" . Carbon::now()->startOfMonth();
    echo "\n<br/>";
    echo "\n<br/>";  // 2022-12-30 00:00:00
    echo "Carbon::now()->startOfMonth() =" . Carbon::now()->endOfMonth();
    echo "\n<br/>";
    echo "\n<br/>";

    echo "Carbon::now()->subMonthNoOverflow()->startOfMonth() =" . Carbon::now()->subMonthNoOverflow()->startOfMonth();    // 2022-12-30 00:00:00
    echo "\n<br/>";
    echo "Carbon::now()->subMonthNoOverflow(2)->startOfMonth() =" . Carbon::now()->subMonthNoOverflow(2)->startOfMonth();    // 2022-12-30 00:00:00
    echo "\n<br/>";
    echo "\n<br/>";
    echo "Carbon::now()->subMonthNoOverflow()->endOfMonth() =" . Carbon::now()->subMonthNoOverflow()->endOfMonth();
    dd();
    $user = Cache::get('user');
    return view('welcome', compact('user'));
});
Route::get('/checkout', function () {
    return view('checkout');
});
