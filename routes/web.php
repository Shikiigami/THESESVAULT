<?php

use App\Http\Controllers\CeatController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\CsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserResearchController;
use App\Http\Controllers\AuditTrailController;
use App\Http\Controllers\UserTableController;
use App\Http\Controllers\UserCeatController;
use App\Http\Controllers\UserCsController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdviserController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\CategorySearchController;
use App\Http\Controllers\CreateAdminController;
use App\Http\Controllers\FrequentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchByDateController;
use App\Http\Controllers\UserAdviserController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UserCategorySearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/Route::middleware(['auth', 'verified'])->group(function () {


Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/user-profile', [UsersController::class, 'index'])->name('user-profile');

Route::get('/userceat-research', [UserCeatController::class, 'index'])->name('user-ceat.index');
Route::get('/usercs-research', [UserCsController::class, 'index'])->name('user-cs.index');
Route::get('/user-favorites', [FavoritesController::class, 'index'])->name('user.favorites');

Route::get('/search-file', [UserResearchController::class, 'search'])->name('search-file');
Route::get('/usersearch-author', [UserCategorySearchController::class,'UserSearchByAuthor'])->name('UserSearchByAuthor');
Route::get('/usersearch-adviser', [UserCategorySearchController::class,'UserSearchByAdviser'])->name('UserSearchByAdviser');
Route::get('/usersearch-college', [UserCategorySearchController::class,'UserSearchByCollege'])->name('UserSearchByCollege');
Route::get('/usersearch-program', [UserCategorySearchController::class,'UserSearchByProgram'])->name('UserSearchByProgram');
Route::get('/searches', [SearchController::class, 'search'])->name('searches');
Route::post('/favorites/add/{id}', [FavoritesController::class, 'addToFavorites'])->name('favorites.add');
Route::post('/ceat-favorites/add/{id}', [UserCeatController::class, 'ceatAddToFavorites'])->name('ceat-favorites.add');
Route::post('/cs-favorites/add/{id}', [UserCsController::class, 'csAddToFavorites'])->name('cs-favorites.add');

Route::delete('/file/{fid}/remove-favorites', [FavoritesController::class, 'destroy'])->name('file.remove');
Route::get('/advisers-list', [UserAdviserController::class, 'index'])->name('user-adviser.index');



Route::get('/user-edit-profile', [ProfileController::class, 'editProfile'])->name('user-edit.profile');
Route::put('/user-profile-update', [ProfileController::class, 'updateProfile'])->name('user-update.profile');
Route::put('/user-password-update', [ProfileController::class, 'changePassword'])->name('user.password');

Route::get('/download/research/{filename}', [UserResearchController::class, 'recordDownload'])->name('download.research');

Route::get('/research-list', [UserResearchController::class, 'index'])->name('all-research');
Route::get('/fetch-fav-research/{id}', [FavoritesController::class, 'favfetchResearch']);
Route::get('/get-view/{filename}', [UserResearchController::class, 'viewAndSave'])->name('get.view');


});

Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('home');
Route::get('/google-redirect', [App\Http\Controllers\SocialController::class, 'googleRedirect']);
Route::get('/auth/google/callback', [App\Http\Controllers\SocialController::class, 'loginWithGoogle']);
Route::get('/', [LandingPageController::class,'index'])->name('landingPage');


Route::get('/login', [App\Http\Controllers\Auth\LoginController::class,'index'])->name('login');

Route::group(['middleware' => 'checkRole:admin'], function () {

Route::get('/admin-profile', [AdminsController::class, 'index'])->name('admin-profile');
Route::get('/edit-profile', [ProfileController::class, 'editProfile'])->name('edit.profile');
Route::put('/profile-update', [ProfileController::class, 'updateProfile'])->name('update.profile');

Route::get('/research-all', [ResearchController::class, 'index'])->name('file.index');
Route::get('/search-research', [ResearchController::class, 'search'])->name('search-research');
Route::post('/file/upload', [ResearchController::class, 'store'])->name('file.upload');
Route::get('/file/{id}/edit', [ResearchController::class, 'edit'])->name('file.edit');
Route::put('/file/{id}/update', [ResearchController::class, 'update'])->name('file.update');
Route::delete('/file/{id}/delete', [ResearchController::class, 'destroy'])->name('file.delete');
Route::delete('/delete-user/{id}', [UserTableController::class, 'destroy'])->name('delete.user');
Route::delete('/batch-delete-users', [UserTableController::class, 'batchDelete'])->name('batch.delete.users');


Route::get('/ceat-research', [CeatController::class, 'index'])->name('ceatfile.index');
Route::get('/advisers', [AdviserController::class, 'index'])->name('adviser.index');
Route::post('/adviser/add', [AdviserController::class, 'store'])->name('adviser.add');
Route::put('/advisers/{adviserId}/update', [AdviserController::class, 'update'] )->name('adviser.update');
Route::delete('/advisers/{adviserId}/delete', [AdviserController::class, 'destroy'])->name('adviser.delete');

Route::get('/cs-research', [CsController::class, 'index'])->name('csfiles.index');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/audit-trail', [AuditTrailController::class, 'index'])->name('user.adudit-trail');
Route::get('/users-data-list', [UserTableController::class, 'index'])->name('user-data.list');
 
Route::get('/generate-pdf-report', [ReportController::class, 'generate'])->name('generate.pdf.report');
Route::get('/generate-Piepdf-report', [ReportController::class, 'generatePiePDF'])->name('generate.Piepdf.report');

Route::get('/search-by-date', [ResearchController::class,'searchByDateRange'])->name('searchByDate');
Route::get('/college-report-Date', [ReportController::class,'generateCollegeReportDate'])->name('collegeReportDate');
Route::get('/program-report-Date', [ReportController::class,'generateProgramReportDate'])->name('programReportDate');

Route::get('/search-author', [CategorySearchController::class,'searchByAuthor'])->name('searchByAuthor');
Route::get('/search-adviser', [CategorySearchController::class,'searchByAdviser'])->name('searchByAdviser');
Route::get('/search-college', [CategorySearchController::class,'searchByCollege'])->name('searchByCollege');
Route::get('/search-program', [CategorySearchController::class,'searchByProgram'])->name('searchByProgram');

Route::post('add-admin', [CreateAdminController::class, 'store'])->name('add.admin');
Route::get('/audit_logs', [AuditLogController::class, 'index'])->name('showLogs');

});

