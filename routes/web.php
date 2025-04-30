<?php

use app\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::post('/export', [ProductController::class, 'export'])->name('products.export');
Route::post('/import', [ProductController::class, 'import'])->name('products.import');
Route::get('/check-key', function () {
    $key = config('app.key');
    $cipher = config('app.cipher');
    
    if (Str::startsWith($key, 'base64:')) {
        $key = base64_decode(substr($key, 7));
    }
    
    $length = strlen($key);
    $requiredLength = match($cipher) {
        'AES-128-CBC', 'AES-128-GCM' => 16,
        'AES-256-CBC', 'AES-256-GCM' => 32,
        default => null,
    };
    
    return [
        'cipher' => $cipher,
        'key_length' => $length,
        'required_length' => $requiredLength,
        'is_valid' => $length === $requiredLength,
    ];
});