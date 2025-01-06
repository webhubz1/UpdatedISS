<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentInformationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BorrowerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/CET-dashboard', function () {
    return view('CET.dashboard');
})->middleware(['auth', 'verified'])->name('CET.dashboard');

Route::get('CET/dashboard', [dashboardController::class, 'dashboard'])->name('CET.dashboard');

// Books Routes
Route::get('CET/Inventory/Book-Dashboard', [BookController::class, 'book'])->name('CET.inventory.book.book-dashboard');

// Additional CRUD routes
Route::get('CET/Inventory/Book/Create', [BookController::class, 'create'])->name('CET.inventory.book.create'); // Create form
Route::post('CET/Inventory/Book/Store', [BookController::class, 'store'])->name('CET.inventory.book.store'); // Store new book
Route::get('CET/Inventory/Book/Edit/{id}', [BookController::class, 'edit'])->name('CET.inventory.book.edit'); // Edit form
Route::put('CET/Inventory/Book/Update/{id}', [BookController::class, 'update'])->name('CET.inventory.book.update');
Route::delete('CET/Inventory/Book/Delete/{id}', [BookController::class, 'destroy'])->name('CET.inventory.book.destroy'); // Delete book
Route::post('/books/import', [BookController::class, 'import'])->name('CET.inventory.book.import');


// Routes for Borrowers
Route::get('CET/Inventory/Borrowers', [BorrowerController::class, 'index'])->name('CET.inventory.borrowers.index'); // Borrowers page
Route::post('CET/Inventory/Borrowers/Store', [BorrowerController::class, 'store'])->name('CET.inventory.borrowers.store'); // Borrow book
Route::patch('/borrowers/{id}/return', [BorrowerController::class, 'setReturn'])->name('CET.inventory.borrowers.return');
Route::get('/borrowers/history', [BorrowerController::class, 'history'])->name('CET.inventory.borrowers.history');




Route::get('CET/student-dashboard', [StudentInformationController::class, 'studentInformation'])->name('CET.student_information.student-dashboard');




Route::get('CET/Inventory/Equipment-Dashboard', [EquipmentController::class, 'equipments'])->name('CET.inventory.equipment.equipment-dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// student information routes//

Route::get('/students/program', [StudentInformationController::class, 'program'])->name('students.program');





Route::prefix('admin')->group(function () {
    Route::get('Add-student', [StudentInformationController::class, 'create'])->name('students.create');
    Route::post('Add-student', [StudentInformationController::class, 'store'])->name('students.store');
    Route::get('View-Student', [StudentInformationController::class, 'viewStudent'])->name('students.view');
    Route::post('View-Student/search', [StudentInformationController::class, 'searchStudent'])->name('students.search');
    Route::post('/students', [StudentInformationController::class, 'store'])->name('students.store');
    Route::get('/students/create', [StudentInformationController::class, 'create']);
    Route::get('/enroll', [StudentInformationController::class, 'create']);  // Display the form
    Route::post('/enroll', [StudentInformationController::class, 'store'])->name('enroll.store');    
    Route::resource('students', StudentInformationController::class);
    Route::get('/', [HomeController::class, 'index']);  
    Route::get('/students/{id}/edit', [StudentInformationController::class, 'edit'])->name('students.edit');
    Route::put('/students/{id}', [StudentInformationController::class, 'update'])->name('students.update');
    Route::get('/export-students', [StudentInformationController::class, 'export'])->name('export.students');
    Route::get('/students/program/{program}', [StudentInformationController::class, 'studentsByProgram'])->name('students.program');
});

Route::get('/students/export/{school_year}/{program}', function ($school_year, $program) {
    return Excel::download(new StudentsExport($school_year, $program), 'students.xlsx');
})->name('students.export');

Route::get('/students/export', [StudentInformationController::class, 'export'])->name('students.export');

Route::get('student/{id}', [StudentInformationController::class, 'show'])->name('view.student');
Route::get('students/{id}', [StudentInformationController::class, 'show'])->name('student.show');

Route::get('/admin/students/{id}', [StudentInformationController::class, 'showStudentProfile'])->name('students.show');

Route::get('/students/{id}/edit', [StudentInformationController::class, 'edit'])->name('students.edit');
Route::put('/students/{id}', [StudentInformationController::class, 'update'])->name('students.update');    

Route::get('/students/export', [StudentInformationController::class, 'export'])->name('students.export');
Route::put('/students/{id}', [StudentInformationController::class, 'update'])->name('students.update');
Route::get('admin/view-student', [StudentInformationController::class, 'index'])->name('admin.View-Student.index');    

Route::get('/student/add', [StudentInformationController::class, 'create'])->name('CET.student_information.add');

// Route to view students
Route::get('/student/view', [StudentInformationController::class, 'index'])->name('CET.student_information.view');
Route::get('/admin/add-student', [StudentInformationController::class, 'addStudent'])->name('admin.Add-student.index');
Route::get('/admin/view-student', [StudentInformationController::class, 'viewStudent'])->name('admin.View-Student.index');
Route::get('/students/export', [StudentInformationController::class, 'export'])->name('students.export');