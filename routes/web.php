<?php

use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;

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
    //宣告變數
    $a = 0;
    $b = [1, 2, 3];
    $c = '你好';
    $d = (object) ['id' => 1];
    $e = ['id' => 1];

    //終止並印出
    //dd($d);

    //宣告變數並裝入books全部資料
    $books = Book::get();
    //dd($books);

    return Inertia::render('Welcome', [
        //     'books' => $books,
        //     'count' => 5,
        //     'title' => '黃昏書店',
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
    // $data = [
    //     'books' => $books,
    //     'count' => 5,
    //     'title' => '黃昏書店'
    // ];

    // return inertia::render('Test', [
    //     'response' => $data,
    // ]);
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/test', [TestController::class, 'index'])->name('test');
    Route::get('/add-book', [TestController::class, 'store'])->middleware(['auth', 'verified']);
    Route::post('/post-book', [TestController::class, 'add'])->middleware(['auth', 'verified']);
    Route::post('/delete-book', [TestController::class, 'deleteBook'])->middleware(['auth', 'verified']);
    Route::post('/update-book', [TestController::class, 'updateBook'])->middleware(['auth', 'verified']);
});

// Route::get('/test', [TestController::class, 'index'])->middleware(['auth', 'verified'])->name('test');

// 新增Book的資料到資料表，用get請求
//Route::get('/add-book', [TestController::class, 'store'])->middleware(['auth', 'verified']);

// 新增Book的資料到資料表，用post請求
//Route::post('/post-book', [TestController::class, 'add'])->middleware(['auth', 'verified']);

// 刪除Book的路由，用post請求
//Route::post('/delete-book', [TestController::class, 'deleteBook'])->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
