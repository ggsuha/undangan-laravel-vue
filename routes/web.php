<?php

use App\Http\Requests\StoreMessage;
use App\Http\Resources\MessageResource;
use App\Models\Guest;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

Route::get('/generate', function (Request $request) {
    $guests = Guest::latest()->get();
    $url = config('app.url');

    return Inertia::render('Generate', compact('guests', 'url'));
});

Route::post('/generate', function (Request $request) {
    Guest::create($request->input());

    return redirect()->back();
});

Route::patch('/generate/{guest}', function (Guest $guest, Request $request) {
    $guest->update($request->input());

    return redirect()->back();
});

Route::delete('/generate/{guest}', function (Guest $guest, Request $request) {
    $guest->delete();

    return redirect()->back();
});

Route::get('/', function (Request $request) {
    $date = Carbon::create(2023, 1, 8);
    $day = $date->translatedFormat('l, d F Y');
    $url = config('app.url');

    return Inertia::render('Dashboard', compact('day', 'url'));
})->name('home');

Route::get('/message', function (Request $request) {
    if (!$request->expectsJson()) {
        return redirect()->route('home');
    }

    $messages = Message::orderByDesc('id')->paginate(10);

    return MessageResource::collection($messages);
});

Route::get('/{slug}', function ($slug, Request $request) {
    $guest = Guest::whereSlug($slug)->first();

    if (!$guest) {
        return redirect()->route('home');
    }

    $forParent = in_array($slug, ['keluarga-karto-rebo', 'keluarga-suwondo', 'alumni-smp-harapan', 'alumni-stm-r-patah']);

    $date = Carbon::create(2023, 1, 8);
    $day = $date->translatedFormat('l, d F Y');

    $url = config('app.url');

    return Inertia::render('Dashboard', compact('day', 'guest', 'url', 'forParent'));
});

Route::post('/message', function (StoreMessage $request) {
    Message::create($request->only(['name', 'message', 'confirm']));

    return redirect()->back();
});

Route::fallback(function () {
    return redirect()->route('home');
});
