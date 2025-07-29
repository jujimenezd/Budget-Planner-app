<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// rutas protegidas en el cual solo se accede si el usuario haya iniciado sesion
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('budgets', BudgetController::class);
    Route::resource('goals', GoalController::class);
    Route::resource('my-profile', UserController::class);

    Route::get('/report/transactions/pdf', [ReportController::class, 'transactionsPdf'])->name('report.transactions.pdf');
    Route::get('/report/budgets/pdf', [ReportController::class, 'budgetsPdf'])->name('report.budgets.pdf');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin-panel', AdminController::class);
});