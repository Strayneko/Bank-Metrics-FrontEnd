<?php

use App\Http\Livewire\Dashboard\Home as HomeDashboard;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Dashboard\ListAdmins;
use App\Http\Livewire\Dashboard\ListUsers;
use App\Http\Livewire\Dashboard\Submission;
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

Route::get('/', HomeDashboard::class)->name('admin.home');

Route::get('/Login', Login::class);

Route::get('/Register', Register::class);

Route::get('/dashboard/list-admin', ListAdmins::class)->name('admin.list');
Route::get('/dashboard/list-user', ListUsers::class)->name('user.list');
Route::get('/dashboard/submission', Submission::class)->name('submission.list');
