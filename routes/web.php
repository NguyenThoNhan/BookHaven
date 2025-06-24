<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\BookPageController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CategoryPageController;
use App\Http\Controllers\Admin\LoanManagementController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\EventPageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\UserDocumentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\VirtualLibraryController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/my-documents/{loan}/edit', [UserDocumentController::class, 'edit'])->name('documents.edit');
Route::patch('/my-documents/{loan}', [UserDocumentController::class, 'update'])->name('documents.update');
Route::get('/my-favorites', [FavoriteController::class, 'index'])->name('favorites.index');
// Route để xử lý việc thêm/xóa yêu thích (sẽ được gọi bằng AJAX)
Route::post('/favorites/{book}/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
});

// =========== USER ROUTES ============

// Trang chủ hiển thị danh sách sách/tài liệu (ai cũng xem được)
Route::get('/', [BookPageController::class, 'index'])->name('home');

// Trang chi tiết sách/tài liệu
Route::get('/books/{book}', [BookPageController::class, 'show'])->name('books.show');

// Các route yêu cầu đăng nhập
Route::middleware('auth')->group(function () {
    // Mượn sách
    Route::post('/loans/{book}', [LoanController::class, 'store'])->name('loans.store');
    
    // Trả sách
    Route::patch('/loans/{loan}', [LoanController::class, 'update'])->name('loans.return');

    // Xem lịch sử mượn của cá nhân
    Route::get('/my-history', [HistoryController::class, 'index'])->name('history.my');
});


// Routes dành cho Admin
Route::middleware(['auth', 'can:is-admin'])->group(function () {
    // Đặt tiền tố 'admin' cho tất cả các route bên trong
    Route::prefix('admin')->name('admin.')->group(function () {
     // Route cho Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route này sẽ tự động tạo các route cho index, create, store, show, edit, update, destroy
    Route::resource('books', BookController::class);
            // Routes cho Quản lý Người dùng
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::resource('categories', CategoryController::class)->except(['show']); // Bỏ route show vì không cần thiết
        Route::get('/loans', [LoanManagementController::class, 'index'])->name('loans.index');
        Route::resource('events', EventController::class);
        // Sau này chúng ta sẽ thêm các route quản lý user, loan ở đây
    });
});

// --- ROUTES CHO TRANG SỰ KIỆN CỦA USER ---
Route::get('/events', [EventPageController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventPageController::class, 'show'])->name('events.show');

// Route để đăng ký sự kiện (cần đăng nhập)
Route::post('/events/{event}/register', [EventPageController::class, 'register'])->middleware('auth')->name('events.register');
// Route để hủy đăng ký sự kiện (cần đăng nhập)
Route::delete('/events/{event}/unregister', [EventPageController::class, 'unregister'])->middleware('auth')->name('events.unregister');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/categories/{category:slug}', [CategoryPageController::class, 'show'])->name('categories.show');
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about.index');
Route::get('/virtual-library', [VirtualLibraryController::class, 'index'])->name('virtual-library.index');
require __DIR__.'/auth.php';
