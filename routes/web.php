<?php

use App\Http\Livewire\Dashboard\Home as HomeDashboard;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Dashboard\ListAdmins;
use App\Http\Livewire\Dashboard\ListUsers;
use App\Http\Livewire\Dashboard\ListBank;

// User
use App\Http\Livewire\User\Profile;
use App\Http\Livewire\User\UserSubmission;
// use App\Http\Livewire\Dashboard\Submission;
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

Route::get('/', HomeDashboard::class)->name('home');

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class);

Route::get('/forgot-password', ForgotPassword::class)->name('ForgotPassword');

Route::get('/dashboard/listadmin', ListAdmins::class)->name('admin.list');
Route::get('/dashboard/listuser', ListUsers::class)->name('user.list');
// Route::get('/dashboard/submission', Submission::class)->name('submission.list');
Route::get('/dashboard/bank', ListBank::class)->name('bank.list');


// Route User
Route::get('/user/profile', Profile::class)->name('user.profile');
Route::get('/user/user-submission', UserSubmission::class)->name('user.user-submission');
