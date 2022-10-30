<?php

use App\Http\Requests\StoreMessage;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Str;

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

Route::get('/', function (Request $request) {
    $date = Carbon::create(2023, 1, 8);
    $day = $date->translatedFormat('l, d F Y');

    $to = Str::title($request->query('to', 'undangan'));
    $url = config('app.url');

    return Inertia::render('Dashboard', compact('day', 'to', 'url'));
})->name('home');

Route::post('/message', function (StoreMessage $request) {
    Message::create($request->only(['name', 'message', 'confirm']));

    return Redirect::route('home');
});

Route::get('/message', function (Request $request) {
    $messages = Message::orderByDesc('id')->paginate(10);

    return MessageResource::collection($messages);
});

Route::fallback(function () {
    return redirect()->route('home');
});
