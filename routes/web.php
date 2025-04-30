<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [MainController::class, 'showLoginForm'])->name('login');
Route::post('/login', [MainController::class, 'login']);
Route::post('/logout', [MainController::class, 'logout'])->name('logout');

// Дополнительные маршруты для регистрации
Route::get('/register', [MainController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [MainController::class, 'register']);

Route::get('/applications', [MainController::class, 'applications'])->name('applications');
 

Route::get('/applicaion/add', [MainController::class, 'applicationCreate']) ->name('applicationsAdd');
Route::post('/applicaion/store', [MainController::class, 'store']) ->name('applicationsCreate');