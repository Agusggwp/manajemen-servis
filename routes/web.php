<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkOrderController;

Route::get('/', [WorkOrderController::class, 'index']);
Route::get('/filter/{status}', [WorkOrderController::class, 'filterByStatus']);
Route::post('/work-orders', [WorkOrderController::class, 'store']);
Route::get('/work-orders/{id}/edit', [WorkOrderController::class, 'edit']);
Route::put('/work-orders/{id}', [WorkOrderController::class, 'update']);
Route::delete('/work-orders/{id}', [WorkOrderController::class, 'destroy']);
Route::patch('/work-orders/{id}/complete', [WorkOrderController::class, 'markCompleted']);
