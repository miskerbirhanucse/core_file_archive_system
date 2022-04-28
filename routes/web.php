<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\file_archive\FileArchiveController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\purchase\PurchaseController;

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
    return view('landing_page.index');
});

Route::middleware(['auth:sanctum', 'verified', 'approve'])->get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

//admin
Route::prefix('admin')->group(function () {
    Route::get('/users', [AdminController::class, 'getAllUsers']);
    Route::post('/update/user/{id}', [AdminController::class, 'updateUser'])->name('admin.update_user');
    Route::get('/edit/{id}', [AdminController::class, 'editUser'])->name('admin.edit_user');
    Route::get('/delete/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete_user');
    Route::get('/purchases', [PurchaseController::class, 'allPurchaseAdmin'])->name('purchase.admin');
    Route::get('/archive', [FileArchiveController::class, 'allArchiveAdmin'])->name('archive.admin');
});

//purchase
Route::prefix('purchase')->group(function () {
    Route::get('/create', [PurchaseController::class, 'create'])->name('purchase');
    Route::get('/allRequest', [PurchaseController::class, 'allPurchaseRequest'])->name('purchase.list');
    Route::get('/edit/{id}', [PurchaseController::class, 'editPurchase'])->name('edit.purchase');
    Route::get('/delete/{id}', [PurchaseController::class, 'deletePurchase'])->name('delete.purchase');
    Route::post('/store', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('/detail/{id}', [PurchaseController::class, 'detail'])->name('detail.purchase');
    Route::put('/approve/{id}', [PurchaseController::class, 'approve'])->name('approve.purchase');
    Route::get('/approvePage', [PurchaseController::class, 'approvePage'])->name('approve.page.purchase');
    Route::get('/authorizePage', [PurchaseController::class, 'authorizePage'])->name('authorize.page.purchase');
    Route::put('/authorize/{id}', [PurchaseController::class, 'authorizePurchase'])->name('authorize.purchase');
    Route::put('/updated/{id}', [PurchaseController::class, 'updatePurchase'])->name('purchase.update');

    Route::get('/store', [PurchaseController::class, 'storeList'])->name('store.list.purchase');
    Route::get('/page', [PurchaseController::class, 'storePage'])->name('store.page.purchase');
    Route::put('/store/{id}', [PurchaseController::class, 'storeApprove'])->name('store.approve.purchase');
    Route::post('/mark-as-read/{id}', [PurchaseController::class, 'markNotification'])->name('mark.notification');
});

Route::post('/pdf', [PurchaseController::class, 'exportPDF'])->name('purchase.export');

//archive
Route::prefix('archive')->group(function () {
    Route::get('/create', [FileArchiveController::class, 'create'])->name('archive.create');
    Route::get('/allArchive', [FileArchiveController::class, 'allArchive'])->name('archive.list');
    Route::post('/store', [FileArchiveController::class, 'store'])->name('archive.store');
    Route::get('/download/{file}', [FileArchiveController::class, 'download'])->name('archive.download');
    Route::get('/search', [FileArchiveController::class, 'search'])->name('archive.search');
    Route::get('/delete/{id}', [FileArchiveController::class, 'deleteArchive'])->name('archive.delete');
    Route::get('/admin/search', [FileArchiveController::class, 'adminSearch'])->name('archive.admin.search');
    Route::get('/edit/{id}', [FileArchiveController::class, 'editArchive'])->name('archive.edit');
    Route::put('/update/{id}', [FileArchiveController::class, 'updateArchive'])->name('archive.update');
    Route::get('/show/report', [FileArchiveController::class, 'showReportPage'])->name('show.archive.report');
    Route::get('/report', [FileArchiveController::class, 'reportArchive'])->name('archive.report');
});

//letter
Route::prefix('letter')->group(function () {
    Route::get('/newLetter',[LetterController::class,'showCreatePage'])->name('letter');
    Route::get('/list',[LetterController::class,'showListPage'])->name('letter.list');
    Route::post('/store',[LetterController::class,'storeLetter'])->name('letter.store');
    Route::get('/download/{id}', [LetterController::class, 'download'])->name('letter.download');
    Route::get('/edit/{id}', [LetterController::class, 'editLetter'])->name('letter.edit');
    Route::put('/secretary/{id}',[LetterController::class,'updateSecretary'])->name('letter.update.secretary');
    Route::put('/update/{id}', [LetterController::class, 'updateLetter'])->name('letter.update');
    Route::get('/search', [LetterController::class, 'search'])->name('letter.search');
    Route::get('/admin/search', [LetterController::class, 'adminSearch'])->name('letter.admin.search');
    Route::get('/gm/list',[LetterController::class,'showGMList'])->name('letter.gm.cc');
    Route::put('/gm/send/{id}',[LetterController::class,'sendLetter'])->name('letter.gm.send');
    Route::get('/delete/{id}', [LetterController::class, 'deleteArchive'])->name('letter.delete');
    Route::get('/detail/{id}', [LetterController::class, 'showDetail'])->name('letter.detail');

    Route::get('/manage',[LetterController::class,'showManage'])->name('letter.manage');
    Route::put('/dp/{id}',[LetterController::class,'depSendLetter'])->name('dp.letter');
    Route::get('/team/letters',[LetterController::class,'teamLetters'])->name('letter.letters');
});