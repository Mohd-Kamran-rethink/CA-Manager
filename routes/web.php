<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannkController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
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

// AUTH ROUTES
Route::get('/',[AuthController::class,'loginView'])->name('loginView');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::get('/logout',[AuthController::class,'logout'])->name('logout')->middleware('validateManager');
Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard')->middleware('validateManager');


Route::middleware('validateManager')->prefix('/users')->group(function () {
    Route::get('',[UserController::class,'listManager'])->name('listManager');
    Route::get('/add',[UserController::class,'addView'])->name('addView');
    Route::post('/add',[UserController::class,'add'])->name('add');
    Route::get('/edit',[UserController::class,'addView'])->name('addView');
    Route::post('/edit',[UserController::class,'edit'])->name('edit');
    Route::post('/delete',[UserController::class,'delete'])->name('delete');
});

Route::middleware('validateManager')->prefix('bank-accounts')->group(function () {
    Route::get('',[BannkController::class,'list'])->name('list');
    Route::get('/add',[BannkController::class,'addForm'])->name('addForm');
    Route::post('/add',[BannkController::class,'add'])->name('add');
    Route::get('/edit/{id}',[BannkController::class,'addForm'])->name('addForm');
    Route::post('/edit',[BannkController::class,'edit'])->name('edit');
    Route::post('/delete',[BannkController::class,'delete'])->name('delete');
    // deposit money
    Route::get('deposit-money/{id}',[BannkController::class,'adddepositForm'])->name('adddepositForm');
    Route::post('/deposit',[BannkController::class,'addDeposit'])->name('addDeposit');
    Route::get('/withdraw-money/{id}',[BannkController::class,'addWithdrawForm'])->name('addWithdrawForm');
    Route::post('/withdraw',[BannkController::class,'addWithdraw'])->name('addWithdraw');
    // view detai;s
    Route::get('/details',[BannkController::class,'viewDetails'])->name('viewDetails');
    Route::post('/reactive',[BannkController::class,'reactivebaNK'])->name('reactivebaNK');
}); 
Route::get('/clients',[UserController::class,'clientList'])->name('clientList')->middleware('validateManager');
Route::get('/clients/add',[UserController::class,'addClient'])->name('addClient');
Route::get('/bankaccount/add',[BannkController::class,'bankAccouAddAjax'])->name('bankAccouAddAjax');
Route::get('/render-client-account',[BannkController::class,'renderClientAccounts'])->name('renderClientAccounts');

// show all the activeity of partitculat clients

Route::get('/clients/transactions/view-details',[UserController::class,'showClientActivity'])->name('showClientActivity')->middleware('validateManager');
Route::get('clients/view-banks',[UserController::class,'viewBankList'])->name('viewBankList')->middleware('validateManager');
Route::get('client/bank-accounts/edit/{id}',[UserController::class,'editbankFrom'])->name('editbankFrom')->middleware('validateManager');
Route::post('client/bank-accounts/edit',[UserController::class,'editBank'])->name('editBank')->middleware('validateManager');
Route::post('/clients/assign',[UserController::class,'clientAssign'])->name('clientAssign')->middleware('validateManager');

// transfers functions are in expense controller
Route::prefix('transfers')->group(function () {
    Route::get('',[TransferController::class,'TransferList'])->name('TransferList');
    Route::get('/add',[TransferController::class,'addTransferForm'])->name('addTransferForm');
    Route::post('/add',[TransferController::class,'addTransfer'])->name('addTransfer');
});

// legder work
Route::prefix('ledgers-groups')->group(function () {
    Route::get('', [LedgerController::class, 'listgroup'])->name('listgroup');
    Route::post('/delete', [LedgerController::class, 'groupdelete'])->name('groupdelete');
    Route::get('/edit', [LedgerController::class, 'groupaddForm'])->name('groupaddForm');
    Route::post('/edit', [LedgerController::class, 'groupedit'])->name('groupedit');
    Route::get('/add', [LedgerController::class, 'groupaddForm'])->name('groupaddForm');
    Route::post('/add', [LedgerController::class, 'groupadd'])->name('groupadd');
});

Route::prefix('ledgers')->group(function () {
    Route::get('', [LedgerController::class, 'list'])->name('list');
    Route::post('/delete', [LedgerController::class, 'delete'])->name('delete');
    Route::get('/edit', [LedgerController::class, 'addForm'])->name('addForm');
    Route::post('/edit', [LedgerController::class, 'edit'])->name('edit');
    Route::get('/add', [LedgerController::class, 'addForm'])->name('addForm');
    Route::post('/add', [LedgerController::class, 'add'])->name('add');
    Route::get('/add-entery', [LedgerController::class, 'addEnteryFrom'])->name('addEnteryFrom');
    Route::get('/view-details', [LedgerController::class, 'viewDetails'])->name('viewDetails');
    Route::post('/view-details', [LedgerController::class, 'viewDetails'])->name('viewDetails');
});
