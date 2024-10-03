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
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\RoleController;

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
Route::post('/delete-history', [SearchController::class, 'deleteHistory'])->name('delete-history');



Route::get('/user-edit-profile', [ProfileController::class, 'editProfile'])->name('user-edit.profile');
Route::put('/user-profile-update', [ProfileController::class, 'updateProfile'])->name('user-update.profile');
Route::put('/user-password-update', [ProfileController::class, 'changePassword'])->name('user.password');

Route::get('/download/research/{filename}', [UserResearchController::class, 'recordDownload'])->name('download.research');

Route::get('/research-list', [UserResearchController::class, 'index'])->name('all-research');
Route::get('/fetch-fav-research/{id}', [FavoritesController::class, 'favfetchResearch']);
Route::get('/get-view/{filename}', [UserResearchController::class, 'viewAndSave'])->name('get.view');

Route::post('/request/research/{id}', [RequestsController::class, 'request'])->name('request.add');
Route::get('/user-requests', [RequestsController::class, 'requestsIndex'])->name('user.requests');
Route::delete('/request/{id}/delete', [RequestsController::class, 'destroy'])->name('delete-requests');

Route::post('/full-text-request/research/{id}', [RequestsController::class, 'addFullRequest'])->name('fullrequest.add');

// college User Routes
Route::get('/usercba-research', [UserResearchController::class, 'userCbaindex'])->name('user-cba.index');
Route::get('/usercnhs-research', [UserResearchController::class, 'userCnhsindex'])->name('user-cnhs.index');
Route::get('/usercte-research', [UserResearchController::class, 'userCteindex'])->name('user-cte.index');
Route::get('/userccje-research', [UserResearchController::class, 'userCcjeindex'])->name('user-ccje.index');
Route::get('/userchtm-research', [UserResearchController::class, 'userChtmindex'])->name('user-chtm.index');
Route::get('/usercah-research', [UserResearchController::class, 'userCahindex'])->name('user-cah.index');

// CCRD user Routes

Route::get('/araceli-campus/research', [UserResearchController::class, 'araceliIndex'])->name('araceli.index');
Route::get('/balabac-campus/research', [UserResearchController::class, 'balabacIndex'])->name('balabac.index');
Route::get('/bataraza-campus/research', [UserResearchController::class, 'batarazaIndex'])->name('bataraza.index');
Route::get('/brookespoint-campus/research', [UserResearchController::class, 'brookespointIndex'])->name('brookespoint.index');
Route::get('/coron-campus/research', [UserResearchController::class, 'coronIndex'])->name('coron.index');
Route::get('/PCATCuyo-campus/research', [UserResearchController::class, 'cuyoIndex'])->name('cuyo.index');
Route::get('/dumaran-campus/research', [UserResearchController::class, 'dumaranIndex'])->name('dumaran.index');
Route::get('/elnido-campus/research', [UserResearchController::class, 'elnidoIndex'])->name('elnido.index');
Route::get('/linapacan-campus/research', [UserResearchController::class, 'linapacanIndex'])->name('linapacan.index');
Route::get('/narra-campus/research', [UserResearchController::class, 'narraIndex'])->name('narra.index');
Route::get('/quezon-campus/research', [UserResearchController::class, 'quezonIndex'])->name('quezon.index');
Route::get('/rizal-campus/research', [UserResearchController::class, 'rizalIndex'])->name('rizal.index');
Route::get('/roxas-campus/research', [UserResearchController::class, 'roxasIndex'])->name('roxas.index');
Route::get('/san-rafael-campus/research', [UserResearchController::class, 'sanrafaelIndex'])->name('sanrafael.index');
Route::get('/san-vicente-campus/research', [UserResearchController::class, 'sanvicenteIndex'])->name('sanvicente.index');
Route::get('/sofronio-española-campus/research', [UserResearchController::class, 'sofronioIndex'])->name('sofronio.index');
Route::get('/taytay-campus/research', [UserResearchController::class, 'taytayIndex'])->name('taytay.index');

});

Auth::routes(['verify' => true]);
Route::post('/send-message', [LandingPageController::class, 'store'])->name('landing-page.store');
Route::get('/role-index',[RoleController::class, 'index'])->name('role.index');
Route::get('/admin-index',[LoginController::class, 'adminIndex'])->name('admin.index');
Route::get('/load-data/{year}', [App\Http\Controllers\DashboardController::class, 'loadData']);
Route::get('/home', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('home');
Route::get('/google-redirect', [App\Http\Controllers\SocialController::class, 'googleRedirect']);
Route::get('/auth/google/callback', [App\Http\Controllers\SocialController::class, 'loginWithGoogle']);
Route::get('/', [LandingPageController::class,'index'])->name('landingPage');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class,'index'])->name('login');


Route::get('/login', [App\Http\Controllers\Auth\LoginController::class,'index'])->name('login');

Route::group(['middleware' => ['auth', 'verified', 'checkRole:admin,sub-admin']], function () {

Route::get('/admin-profile', [AdminsController::class, 'index'])->name('admin-profile');
Route::get('/edit-profile', [ProfileController::class, 'editProfile'])->name('edit.profile');
Route::put('/profile-update', [ProfileController::class, 'updateProfile'])->name('update.profile');

Route::get('/research-all', [ResearchController::class, 'index'])->name('file.index');
Route::get('/search-research', [ResearchController::class, 'search'])->name('search-research');
Route::post('/file/upload', [ResearchController::class, 'store'])->name('file.upload');
Route::post('/dissertation/upload', [ResearchController::class, 'storeDissertation'])->name('dissertation.upload');
Route::put('/dissertation/{id}/edit', [ResearchController::class, 'updateDissertation'])->name('dissertation.update');
Route::get('/file/{id}/edit', [ResearchController::class, 'edit'])->name('file.edit');
Route::put('/file/{id}/update', [ResearchController::class, 'update'])->name('file.update');
Route::delete('/file/{id}/delete', [ResearchController::class, 'destroy'])->name('file.delete');
Route::delete('/delete-user/{id}', [UserTableController::class, 'destroy'])->name('delete.user');
Route::delete('/batch-delete-users', [UserTableController::class, 'batchDelete'])->name('batch.delete.users');
Route::get('/adviser-fetching-endpoint', [ResearchController::class, 'fetchAdvisers']);
Route::get('/filter-advisers', [AdviserController::class, 'filterAdvisers'])->name('filter.advisers');
Route::get('/advisers/filter', [AdviserController::class, 'filter'])->name('filter');



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
Route::post('add-field', [AdminsController::class, 'storeField'])->name('add.field');
Route::get('/audit_logs', [AuditTrailController::class, 'index'])->name('showLogs');
Route::get('/approval-sheet/{id}', [ResearchController::class, 'approvalSheet'])->name('approvalSheet');

Route::get('/requests-lists', [RequestsController::class, 'index'])->name('requests.list');
Route::put('/request/{id}/request_status/approved', [RequestsController::class,'approvedStatus'])->name('request.approved');
Route::put('/request/{id}/request_status/declined', [RequestsController::class,'declinedStatus'])->name('request.declined');
Route::put('/request/{id}/request_status/undo', [RequestsController::class,'undo'])->name('request.undo');
Route::get('/requests-total', [RequestsController::class, 'totalIndex'])->name('requests.total');

Route::get('/requests-lists/full-text', [RequestsController::class, 'fullTextRequestsIndex'])->name('fullrequests.list');
Route::put('/request/{id}/fullrequest_status/approved', [RequestsController::class,'fullApprovedStatus'])->name('fullrequest.approved');
Route::put('/request/{id}/fullrequest_status/declined', [RequestsController::class,'fullDeclinedStatus'])->name('fullrequest.declined');

// College Routes
Route::get('/cba-research', [ResearchController::class, 'cbaIndex'])->name('cbafiles.index');
Route::get('/cnhs-research', [ResearchController::class, 'cnhsIndex'])->name('cnhsfiles.index');
Route::get('/cte-research', [ResearchController::class, 'cteIndex'])->name('ctefiles.index');
Route::get('/ccje-research', [ResearchController::class, 'ccjeIndex'])->name('ccjefiles.index');
Route::get('/chtm-research', [ResearchController::class, 'chtmIndex'])->name('chtmfiles.index');
Route::get('/cah-research', [ResearchController::class, 'cahIndex'])->name('cahfiles.index');

// CCRD Routes
Route::get('/araceli-research', [ResearchController::class, 'araceliIndex'])->name('aracelifiles.index');
Route::get('/balabac-research', [ResearchController::class, 'balabacIndex'])->name('balabacfiles.index');
Route::get('/bataraza-research', [ResearchController::class, 'batarazaIndex'])->name('batarazafiles.index');
Route::get('/brookespoint-research', [ResearchController::class, 'brookespointIndex'])->name('brookespointfiles.index');
Route::get('/coron-research', [ResearchController::class, 'coronIndex'])->name('coronfiles.index');
Route::get('/pcat-cuyo-research', [ResearchController::class, 'cuyoIndex'])->name('cuyofiles.index');
Route::get('/dumaran-research', [ResearchController::class, 'dumaranIndex'])->name('dumaranfiles.index');
Route::get('/elnido-research', [ResearchController::class, 'elnidoIndex'])->name('elnidofiles.index');
Route::get('/linapacan-research', [ResearchController::class, 'linapacanIndex'])->name('linapacanfiles.index');
Route::get('/narra-research', [ResearchController::class, 'narraIndex'])->name('narrafiles.index');
Route::get('/quezon-research', [ResearchController::class, 'quezonIndex'])->name('quezonfiles.index');
Route::get('/rizal-research', [ResearchController::class, 'rizalIndex'])->name('rizalfiles.index');
Route::get('/roxas-research', [ResearchController::class, 'roxasIndex'])->name('roxasfiles.index');
Route::get('/San-Rafael-research', [ResearchController::class, 'sanrafaelIndex'])->name('sanrafaelfiles.index');
Route::get('/San-Vicente-research', [ResearchController::class, 'sanvicenteIndex'])->name('sanvicentefiles.index');
Route::get('/Sofronio-Española-research', [ResearchController::class, 'sofronioIndex'])->name('sofroniofiles.index');
Route::get('/Taytay-research', [ResearchController::class, 'taytayIndex'])->name('taytayfiles.index');
Route::get('/diploma-in-teaching-dissertations', [ResearchController::class, 'diplomaInTech'])->name('diplomaInTech.index');
Route::get('/doctor-of-education', [ResearchController::class, 'doctorEd'])->name('doctorEd.index');


Route::get('/recent-login/users', [UsersController::class, 'recentlogin'])->name('recent-login');
Route::get('/getMonths/{year}', [UsersController::class, 'getMonths'])->name('getMonths');
Route::post('login/by_month', [UsersController::class, 'loginByMonth'])->name('login.by_month');
Route::post('/select-year', [UsersController::class, 'selectYear'])->name('select-year');

Route::get('/program-statistics', [UsersController::class, 'programIndex'])->name('program.index');
Route::get('/load-data/program/{year}', [App\Http\Controllers\UsersController::class, 'loadDataProgram']);
Route::get('/generate-pdf/report', [ReportController::class, 'generateLoginPDF'])->name('loginReport.program');
Route::get('/generate-pdf/report/yearly', [ReportController::class, 'generateLoginYearPDF'])->name('loginReportByYear.program');
Route::get('/generate-pdf/report/today', [ReportController::class, 'generateLoginDayPDF'])->name('loginReportByDay.program');

});

