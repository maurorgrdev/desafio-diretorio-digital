<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FornecedorController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/login', [AuthController::class, 'login']) ->name('login');

Route::get('/verify-token', [AuthController::class, 'verifyToken']);
                


Route::group(['middleware' => ['apiJwt']], function (){
    Route::resource('/fornecedores', FornecedorController::class);
    
    Route::get('/user/show-user-log', [UserController::class, 'showUserLog']);

    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
});




// Route::resource('/fornecedores', FornecedorController::class);

Route::get('download-fornecedor/{id}', [FornecedorController::class, 'downloadArquivo']);
Route::delete('delete-fornecedor/{id}', [FornecedorController::class, 'deleteArquivo']);
Route::post('upload-fornecedor', [FornecedorController::class, 'uploadArquivo']);