<?php

use App\Http\Controllers\ApproveSeminarController;
use App\Http\Controllers\ApproveSidangController;
use App\Http\Controllers\DaftarSeminarController;
use App\Http\Controllers\DaftarSidangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\TahunAjaranController;
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

Route::get('/', fn () => redirect()->route('login'));

Route::group(['middleware' => 'ceklevel:1,2,3'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profil');
    Route::post('/updateprofile', [UserController::class, 'updateProfile'])->name('update.profil');
    Route::get('/password', [UserController::class, 'password'])->name('user.password');
    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update.password');
    Route::get('/dashboard-sidang', [DashboardController::class, 'indexSidang'])->name('dashboard.sidang');
});

Route::group(['prefix' => '/datamaster', 'middleware' => 'ceklevel:1'], function () {

    Route::get('/dashboard', [DashboardController::class, 'indexData'])->name('dashboard.datamaster');
    // CRUD mahasiswa
    Route::get('/mahasiswa/index', [UserController::class, 'indexMahasiswa'])->name('mahasiswa.index');
    Route::get('/mahasiswa/data', [UserController::class, 'dataMahasiswa'])->name('mahasiswa.data');
    Route::post('/mahasiswa/store', [UserController::class, 'storeMahasiswa'])->name('mahasiswa.store');
    Route::get('/mahasiswa/show/{id}', [UserController::class, 'showMahasiswa'])->name('mahasiswa.show');
    Route::get('/mahasiswa/edit/{id}', [UserController::class, 'editMahasiswa'])->name('mahasiswa.edit');
    Route::post('/mahasiswa/update/{id}', [UserController::class, 'updateMahasiswa'])->name('mahasiswa.update');
    Route::post('/mahasiswa/delete/{id}', [UserController::class, 'deleteMahasiswa'])->name('mahasiswa.destroy');
    Route::post('/mahasiswa/delete_selected', [UserController::class, 'deleteSelectedMahasiswa'])->name('mahasiswa.delete-selected');
    Route::get('/mahasiswa/page/import', [UserController::class, 'importPageMhs'])->name('mahasiswa.import-page');
    Route::post('/mahasiswa/import', [UserController::class, 'importMhs'])->name('mahasiswa.import');
    // CRUD admin
    Route::get('/admin/index', [UserController::class, 'indexAdmin'])->name('admin.index');
    Route::get('/admin/data', [UserController::class, 'dataAdmin'])->name('admin.data');
    Route::post('/admin/store', [UserController::class, 'storeAdmin'])->name('admin.store');
    Route::get('/admin/show/{id}', [UserController::class, 'showAdmin'])->name('admin.show');
    Route::get('/admin/edit/{id}', [UserController::class, 'editAdmin'])->name('admin.edit');
    Route::post('/admin/update/{id}', [UserController::class, 'updateAdmin'])->name('admin.update');
    Route::post('/admin/delete/{id}', [UserController::class, 'deleteAdmin'])->name('admin.destroy');
    Route::post('/admin/delete/selected', [UserController::class, 'deleteSelectedAdmin'])->name('admin.delete-selected');
    // CRUD dosen
    Route::get('/dosen/index', [UserController::class, 'indexDosen'])->name('dosen.index');
    Route::get('/dosen/data', [UserController::class, 'dataDosen'])->name('dosen.data');
    Route::post('/dosen/store', [UserController::class, 'storeDosen'])->name('dosen.store');
    Route::get('/dosen/show/{id}', [UserController::class, 'showDosen'])->name('dosen.show');
    Route::get('/dosen/edit/{id}', [UserController::class, 'editDosen'])->name('dosen.edit');
    Route::post('/dosen/update/{id}', [UserController::class, 'updateDosen'])->name('dosen.update');
    Route::get('/dosen/delete/{id}', [UserController::class, 'deleteDosen'])->name('dosen.destroy');
    Route::post('/dosen/delete/selected', [UserController::class, 'deleteSelectedDosen'])->name('dosen.delete-selected');
    Route::get('/dosen/page/import', [UserController::class, 'importPageDosen'])->name('dosen.import-page');
    Route::post('/dosen/import', [UserController::class, 'importDosen'])->name('dosen.import');
    // CRUD SEMESTER
    Route::get('/semester/index', [SemesterController::class, 'index'])->name('semester.index');
    Route::get('/semester/data', [SemesterController::class, 'data'])->name('semester.data');
    Route::post('/semester/store', [SemesterController::class, 'store'])->name('semester.store');
    Route::get('/semester/edit/{id}', [SemesterController::class, 'edit'])->name('semester.edit');
    Route::post('/semester/update/{id}', [SemesterController::class, 'update'])->name('semester.update');
    Route::post('/semester/{id}/delete', [SemesterController::class, 'delete'])->name('semester.destroy');
    // CRUD tahun ajaran
    Route::get('/tahunajaran/index', [TahunAjaranController::class, 'index'])->name('tahunajaran.index');
    Route::get('/tahunajaran/data', [TahunAjaranController::class, 'data'])->name('tahunajaran.data');
    Route::post('/tahunajaran/store', [TahunAjaranController::class, 'store'])->name('tahunajaran.store');
    Route::get('/tahunajaran/edit/{id}', [TahunAjaranController::class, 'edit'])->name('tahunajaran.edit');
    Route::post('/tahunajaran/update/{id}', [TahunAjaranController::class, 'update'])->name('tahunajaran.update');
    Route::get('/tahunajaran/delete/{id}', [TahunAjaranController::class, 'delete'])->name('tahunajaran.destroy');
});

Route::group(['prefix' => '/dokumentasi_sidang', 'middleware' => 'ceklevel:3'], function () {
    Route::get('seminar/ti', [DaftarSeminarController::class, 'indexTi'])->name('seminar_ti.index');
    Route::get('daftar/seminar/ti', [DaftarSeminarController::class, 'daftarTi'])->name('seminar_ti.daftar');
    Route::post('store/seminar/ti', [DaftarSeminarController::class, 'storeTi'])->name('seminar_ti.store');
    Route::get('edit/seminar/ti/{id}', [DaftarSeminarController::class, 'editTi'])->name('seminar_ti.edit');
    Route::post('update/seminar/ti/{id}', [DaftarSeminarController::class, 'updateTi'])->name('seminar_ti.update');
    Route::get('show/seminar/ti/{id}', [DaftarSeminarController::class, 'showTi'])->name('seminar_ti.show');

    Route::get('seminar/tmb', [DaftarSeminarController::class, 'indexTmb'])->name('seminar_tmb.index');
    Route::get('daftar/seminar/tmb', [DaftarSeminarController::class, 'daftarTmb'])->name('seminar_tmb.daftar');
    Route::post('store/seminar/tmb', [DaftarSeminarController::class, 'storeTmb'])->name('seminar_tmb.store');
    Route::get('edit/seminar/tmb/{id}', [DaftarSeminarController::class, 'editTmb'])->name('seminar_tmb.edit');
    Route::post('update/seminar/tmb/{id}', [DaftarSeminarController::class, 'updateTmb'])->name('seminar_tmb.update');
    Route::get('show/seminar/tmb/{id}', [DaftarSeminarController::class, 'showTmb'])->name('seminar_tmb.show');

    Route::get('seminar/pwk', [DaftarSeminarController::class, 'indexPwk'])->name('seminar_pwk.index');
    Route::get('daftar/seminar/pwk', [DaftarSeminarController::class, 'daftarPwk'])->name('seminar_pwk.daftar');
    Route::post('store/seminar/pwk', [DaftarSeminarController::class, 'storePwk'])->name('seminar_pwk.store');
    Route::get('edit/seminar/pwk/{id}', [DaftarSeminarController::class, 'editPwk'])->name('seminar_pwk.edit');
    Route::post('update/seminar/pwk/{id}', [DaftarSeminarController::class, 'updatePwk'])->name('seminar_pwk.update');
    Route::get('show/seminar/pwk/{id}', [DaftarSeminarController::class, 'showPwk'])->name('seminar_pwk.show');

    Route::get('sidang/tmb', [DaftarSidangController::class, 'indexTmb'])->name('sidang_tmb.index');
    Route::get('daftar/sidang/tmb', [DaftarSidangController::class, 'daftarTmb'])->name('sidang_tmb.daftar');
    Route::post('store/sidang/tmb', [DaftarSidangController::class, 'storeTmb'])->name('sidang_tmb.store');
    Route::get('edit/sidang/tmb/{id}', [DaftarSidangController::class, 'editTmb'])->name('sidang_tmb.edit');
    Route::post('update/sidang/tmb/{id}', [DaftarSidangController::class, 'updateTmb'])->name('sidang_tmb.update');
    Route::get('show/sidang/tmb/{id}', [DaftarSidangController::class, 'showTmb'])->name('sidang_tmb.show');

    Route::get('sidang/ti', [DaftarSidangController::class, 'indexTi'])->name('sidang_ti.index');
    Route::get('daftar/sidang/ti', [DaftarSidangController::class, 'daftarTi'])->name('sidang_ti.daftar');
    Route::post('store/sidang/ti', [DaftarSidangController::class, 'storeTi'])->name('sidang_ti.store');
    Route::get('edit/sidang/ti/{id}', [DaftarSidangController::class, 'editTi'])->name('sidang_ti.edit');
    Route::post('update/sidang/ti/{id}', [DaftarSidangController::class, 'updateTi'])->name('sidang_ti.update');
    Route::get('show/sidang/ti/{id}', [DaftarSidangController::class, 'showTi'])->name('sidang_ti.show');

    Route::get('sidang/pwk', [DaftarSidangController::class, 'indexPwk'])->name('sidang_pwk.index');
    Route::get('daftar/sidang/pwk', [DaftarSidangController::class, 'daftarPwk'])->name('sidang_pwk.daftar');
    Route::post('store/sidang/pwk', [DaftarSidangController::class, 'storePwk'])->name('sidang_pwk.store');
    Route::get('edit/sidang/pwk/{id}', [DaftarSidangController::class, 'editPwk'])->name('sidang_pwk.edit');
    Route::post('update/sidang/pwk/{id}', [DaftarSidangController::class, 'updatePwk'])->name('sidang_pwk.update');
    Route::get('show/sidang/pwk/{id}', [DaftarSidangController::class, 'showPwk'])->name('sidang_pwk.show');
});

Route::group(['prefix' => '/dokumentasi_sidang', 'middleware' => 'ceklevel:2'], function () {
    Route::get('view-seminar/tmb', [ApproveSeminarController::class, 'viewTmb'])->name('view-seminarTmb.index');
    Route::get('view-seminar/tmb/data', [ApproveSeminarController::class, 'dataTmb'])->name('view-seminarTmb.data');
    Route::match(['get', 'post'], '/approval-seminar/tmb/{id}', [ApproveSeminarController::class, 'approveTmb'])->name('approve-seminarTmb.store');
    Route::get('rekap-seminar/tmb', [ApproveSeminarController::class, 'rekapTmb'])->name('rekap-seminarTmb.index');
    Route::get('rekap-seminar/tmb/data', [ApproveSeminarController::class, 'dataRekapTmb'])->name('rekap-seminarTmb.data');
    Route::get('show-seminar/tmb/{id}', [ApproveSeminarController::class, 'showRekapTmb'])->name('rekap-seminarTmb.show');

    Route::get('view-seminar/ti', [ApproveSeminarController::class, 'viewTi'])->name('view-seminarTi.index');
    Route::get('view-seminar/ti/data', [ApproveSeminarController::class, 'dataTi'])->name('view-seminarTi.data');
    Route::match(['get', 'post'], '/approval-seminar/ti/{id}', [ApproveSeminarController::class, 'approveTi'])->name('approve-seminarTi.store');
    Route::get('rekap-seminar/ti', [ApproveSeminarController::class, 'rekapTi'])->name('rekap-seminarTi.index');
    Route::get('rekap-seminar/ti/data', [ApproveSeminarController::class, 'dataRekapTi'])->name('rekap-seminarTi.data');
    Route::get('show-seminar/ti/{id}', [ApproveSeminarController::class, 'showRekapTi'])->name('rekap-seminarTi.show');

    Route::get('view-seminar/pwk', [ApproveSeminarController::class, 'viewPwk'])->name('view-seminarPwk.index');
    Route::get('view-seminar/pwk/data', [ApproveSeminarController::class, 'dataPwk'])->name('view-seminarPwk.data');
    Route::match(['get', 'post'], '/approval-seminar/pwk/{id}', [ApproveSeminarController::class, 'approvePwk'])->name('approve-seminarPwk.store');
    Route::get('rekap-seminar/pwk', [ApproveSeminarController::class, 'rekapPwk'])->name('rekap-seminarPwk.index');
    Route::get('rekap-seminar/pwk/data', [ApproveSeminarController::class, 'dataRekapPwk'])->name('rekap-seminarPwk.data');
    Route::get('show-seminar/pwk/{id}', [ApproveSeminarController::class, 'showRekapPwk'])->name('rekap-seminarPwk.show');


    Route::get('view-sidang/tmb', [ApproveSidangController::class, 'viewTmb'])->name('view-sidangTmb.index');
    Route::get('view-sidang/tmb/data', [ApproveSidangController::class, 'dataTmb'])->name('view-sidangTmb.data');
    Route::match(['get', 'post'], '/approval-sidang/tmb/{id}', [ApproveSidangController::class, 'approveTmb'])->name('approve-sidangTmb.store');
    Route::get('rekap-sidang/tmb', [ApproveSidangController::class, 'rekapTmb'])->name('rekap-sidangTmb.index');
    Route::get('rekap-sidang/tmb/data', [ApproveSidangController::class, 'dataRekapTmb'])->name('rekap-sidangTmb.data');
    Route::get('show-sidang/tmb/{id}', [ApproveSidangController::class, 'showRekapTmb'])->name('rekap-sidangTmb.show');

    Route::get('view-sidang/ti', [ApproveSidangController::class, 'viewTi'])->name('view-sidangTi.index');
    Route::get('view-sidang/ti/data', [ApproveSidangController::class, 'dataTi'])->name('view-sidangTi.data');
    Route::match(['get', 'post'], '/approval-sidang/ti/{id}', [ApproveSidangController::class, 'approveTi'])->name('approve-sidangTi.store');
    Route::get('rekap-sidang/ti', [ApproveSidangController::class, 'rekapTi'])->name('rekap-sidangTi.index');
    Route::get('rekap-sidang/ti/data', [ApproveSidangController::class, 'dataRekapTi'])->name('rekap-sidangTi.data');
    Route::get('show-sidang/ti/{id}', [ApproveSidangController::class, 'showRekapTi'])->name('rekap-sidangTi.show');

    Route::get('view-sidang/pwk', [ApproveSidangController::class, 'viewPwk'])->name('view-sidangPwk.index');
    Route::get('view-sidang/pwk/data', [ApproveSidangController::class, 'dataPwk'])->name('view-sidangPwk.data');
    Route::match(['get', 'post'], '/approval-sidang/pwk/{id}', [ApproveSidangController::class, 'approvePwk'])->name('approve-sidangPwk.store');
    Route::get('rekap-sidang/pwk', [ApproveSidangController::class, 'rekapPwk'])->name('rekap-sidangPwk.index');
    Route::get('rekap-sidang/pwk/data', [ApproveSidangController::class, 'dataRekapPwk'])->name('rekap-sidangPwk.data');
    Route::get('show-sidang/pwk/{id}', [ApproveSidangController::class, 'showRekapPwk'])->name('rekap-sidangPwk.show');
});





// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
