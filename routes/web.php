<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\ApproveSeminarController;
use App\Http\Controllers\ApproveSidangController;
use App\Http\Controllers\ApproveSkkftController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\CategoryArsipController;
use App\Http\Controllers\CategorySkkftController;
use App\Http\Controllers\ClaimSkkftController;
use App\Http\Controllers\DaftarSeminarController;
use App\Http\Controllers\DaftarSidangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DependenDropdownController;
use App\Http\Controllers\DownloadSeminarController;
use App\Http\Controllers\DownloadSidangController;
use App\Http\Controllers\JabatanSkkftController;
use App\Http\Controllers\KegiatanSkkftController;
use App\Http\Controllers\MyArchiveController;
use App\Http\Controllers\PointSkkftController;
use App\Http\Controllers\PrestasiSkkftController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SertifikatSkkftController;
use App\Http\Controllers\SkpiController;
use App\Http\Controllers\SubcategoryArsipController;
use App\Http\Controllers\SubcategorySkkftController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\TingkatSkkftController;
use App\Http\Controllers\UserController;
use App\Models\SertifikatSkkft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

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
    Route::get('/dashboard/mahasiswa-data', [DashboardController::class, 'dataMahasiswa'])->name('dashboard.mahasiswa');
    Route::get('/dashboard/mahasiswa/{id}', [DashboardController::class, 'showMahasiswa'])->name('dashboardMahasiswa.show');
    Route::get('/dashboard/dosen-data', [DashboardController::class, 'dataDosen'])->name('dashboard.dosen');
    Route::get('/dashboard/dosen/{id}', [DashboardController::class, 'showDosen'])->name('dashboardDosen.show');
    Route::get('/dashboard/admin/{id}', [DashboardController::class, 'showAdmin'])->name('dashboardAdmin.show');
    Route::get('/dashboard/rekap-lulusan', [DashboardController::class, 'rekapLulusan'])->name('dashboard.rekapLulusan');
    Route::get('/dashboard/rekap-lulusan/{id}', [DashboardController::class, 'showRekapLulusan'])->name('rekapLulusan.show');
    Route::get('/dashboard/excel-export-sidang', [DashboardController::class, 'exportExcelLulusan'])->name('lulusanExcel.export');
    Route::match(['get', 'post'], '/alumni/show-edit', [AlumniController::class, 'showEdit'])->name('alumni.show-edit');
});

// DATA MASTER Role ADMIN
Route::group(['prefix' => '/datamaster'], function () {

    Route::group(['middleware' => 'ceklevel:1'], function () {
        Route::get('/dashboard', [DashboardController::class, 'indexData'])->name('dashboard.datamaster');
        // View All Users
        Route::get('/users', [UserController::class, 'indexUsers'])->name('users.index');
        Route::get('/data-users', [UserController::class, 'dataUsers'])->name('users.data');
        Route::get('/data-users/{id}', [UserController::class, 'showUsers'])->name('users.show');
        Route::post('/reset-password-user/{id}', [UserController::class, 'resetPassword'])->name('user-password.reset');
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
        Route::get('/dosen/edit-all', [UserController::class, 'editAllDosen'])->name('dosen.editAll');
        // Route::get('/dosen/edit-data', [UserController::class, 'editDataDosen'])->name('dosen.editData');
        Route::post('/dosen/update-all', [UserController::class, 'updateAllDosen'])->name('dosen.updateAll');
        Route::get('/dosen/delete/{id}', [UserController::class, 'deleteDosen'])->name('dosen.destroy');
        Route::post('/dosen/delete/selected', [UserController::class, 'deleteSelectedDosen'])->name('dosen.delete-selected');
        Route::get('/dosen/page/import', [UserController::class, 'importPageDosen'])->name('dosen.import-page');
        Route::post('/dosen/import', [UserController::class, 'importDosen'])->name('dosen.import');
        // CRUD Alumni
        Route::resource('/alumni', AlumniController::class)->except(['index', 'show']);
        Route::get('/alumni/page/import', [AlumniController::class, 'importPageAlumni'])->name('alumni.import-page');
        Route::post('/alumni/import', [AlumniController::class, 'importAlumni'])->name('alumni.import');
        Route::post('/alumni/reset-pwd/{id}', [AlumniController::class, 'resetPwd'])->name('alumni.reset-password');
        // CRUD SEMESTER
        Route::resource('/semester', SemesterController::class);
        Route::get('/semester-data', [SemesterController::class, 'data'])->name('semester.data');
        // CRUD tahun ajaran
        Route::resource('/tahunajaran', TahunAjaranController::class);
        Route::get('/tahun_ajaran-data', [TahunAjaranController::class, 'data'])->name('tahunajaran.data');
        // CRUD SECTION arsip
        Route::resource('sections', SectionController::class);
        Route::get('data/sections', [SectionController::class, 'data'])->name('sections.data');
        // CRUD category arsip
        Route::resource('category-archive', CategoryArsipController::class);
        Route::get('data/category-archive', [CategoryArsipController::class, 'data'])->name('category-archive.data');

        // CRUD sub category arsip
        Route::resource('sub-category-archive', SubcategoryArsipController::class);
        Route::get('data/sub-category-archive', [SubcategoryArsipController::class, 'data'])->name('sub-category-archive.data');

        // CRUD CATEGORY , SUBCATEGORY, TINGKAT, JABATAN, PRESTASI, POIN SKKFT
        Route::resource('/category-skkft', CategorySkkftController::class);
        Route::resource('/subcategory-skkft', SubcategorySkkftController::class);
        Route::resource('/tingkat-skkft', TingkatSkkftController::class);
        Route::resource('/jabatan-skkft', JabatanSkkftController::class);
        Route::resource('/prestasi-skkft', PrestasiSkkftController::class);
        Route::resource('/poin-skkft', PointSkkftController::class);
        
        // view pelaksanaan seminar
        Route::get('pelaksanaan-sidang/pembahasan-pwk', [ApproveSeminarController::class, 'viewAdminPwk'])->name('adminPembahasanPwk.index');
        Route::get('pelaksanaan-sidang/pembahasan-pwk-data', [ApproveSeminarController::class, 'viewDataAdminPwk'])->name('adminPembahasanPwk.data');
        Route::get('pelaksanaan-sidang/pembahasan-pwk-show/{id}', [ApproveSeminarController::class, 'showAdminPwk'])->name('adminPembahasanPwk.show');
        Route::get('pelaksanaan-sidang/kolokium-tmb', [ApproveSeminarController::class, 'viewAdminTmb'])->name('adminKolokiumTmb.index');
        Route::get('pelaksanaan-sidang/kolokium-tmb-data', [ApproveSeminarController::class, 'viewDataAdminTmb'])->name('adminKolokiumTmb.data');
        Route::get('pelaksanaan-sidang/kolokium-tmb-show/{id}', [ApproveSeminarController::class, 'showAdminTmb'])->name('adminKolokiumTmb.show');
        Route::get('pelaksanaan-sidang/seminar-ti', [ApproveSeminarController::class, 'viewAdminTi'])->name('adminSeminarTi.index');
        Route::get('pelaksanaan-sidang/seminar-ti-data', [ApproveSeminarController::class, 'viewDataAdminTi'])->name('adminSeminarTi.data');
        Route::get('pelaksanaan-sidang/seminar-ti-show/{id}', [ApproveSeminarController::class, 'showAdminTi'])->name('adminSeminarTi.show');

        // View pelaksanaan sidang
        Route::get('pelaksanaan-sidang/terbuka-pwk', [ApproveSidangController::class, 'viewAdminPwk'])->name('adminTerbukaPwk.index');
        Route::get('pelaksanaan-sidang/terbuka-pwk-data', [ApproveSidangController::class, 'viewDataAdminPwk'])->name('adminTerbukaPwk.data');
        Route::get('pelaksanaan-sidang/terbuka-pwk-show/{id}', [ApproveSidangController::class, 'showAdminPwk'])->name('adminTerbukaPwk.show');
        Route::get('pelaksanaan-sidang/skripsi-tmb', [ApproveSidangController::class, 'viewAdminTmb'])->name('adminSkripsiTmb.index');
        Route::get('pelaksanaan-sidang/skripsi-tmb-data', [ApproveSidangController::class, 'viewDataAdminTmb'])->name('adminSkripsiTmb.data');
        Route::get('pelaksanaan-sidang/skripsi-tmb-show/{id}', [ApproveSidangController::class, 'showAdminTmb'])->name('adminSkripsiTmb.show');
        Route::get('pelaksanaan-sidang/sidang-ti', [ApproveSidangController::class, 'viewAdminTi'])->name('adminSidangTi.index');
        Route::get('pelaksanaan-sidang/sidang-ti-data', [ApproveSidangController::class, 'viewDataAdminTi'])->name('adminSidangTi.data');
        Route::get('pelaksanaan-sidang/sidang-ti-show/{id}', [ApproveSidangController::class, 'showAdminTi'])->name('adminSidangTi.show');
    });

    Route::group(['middleware' => 'ceklevel:1,2'], function () {
        Route::get('/data-user/mahasiswa', [UserController::class, 'tendikMahasiswa'])->name('tendikMahasiswa');
        Route::get('/data-user/mahasiswa-data', [UserController::class, 'tendikDataMahasiswa'])->name('tendikDataMahasiswa');
        Route::get('/data-user/dosen', [UserController::class, 'tendikDosen'])->name('tendikDosen');
        Route::get('/data-user/dosen-data', [UserController::class, 'tendikDataDosen'])->name('tendikDataDosen');
        Route::get('/data-user/admin', [UserController::class, 'tendikAdmin'])->name('tendikAdmin');
        Route::get('/data-user/admin-data', [UserController::class, 'tendikDataAdmin'])->name('tendikDataAdmin');
        Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
        Route::get('/alumni-data', [AlumniController::class, 'data'])->name('alumni.data');
        Route::get('/alumni/{id}', [AlumniController::class, 'show'])->name('alumni.show');
    });
   
});

Route::group(['prefix'=>'/skkft'], function(){

    Route::get('dropdownlist/subcategory-skkft/{id}', [DependenDropdownController::class, 'getDataSubCategory'])->name('get-subcategoryskkft.data');
    Route::get('dropdownlist/tingkat-skkft/{id}', [DependenDropdownController::class, 'getDataTingkat'])->name('get-tingkatskkft.data');
    Route::get('dropdownlist/prestasi-skkft/{id}', [DependenDropdownController::class, 'getDataPrestasi'])->name('get-prestasiskkft.data');
    Route::get('dropdownlist/jabatan-skkft/{id}', [DependenDropdownController::class, 'getDataJabatan'])->name('get-jabatanskkft.data');

    // SKKFT ADMIN
    Route::group(['middleware'=>'ceklevel:1'], function(){
        Route::get('/dashboard-skkft', [ApproveSkkftController::class, 'index'])->name('dashboardSkkft.index');
        Route::get('/data-skkft-index', [ApproveSkkftController::class, 'indexData'])->name('dataSkkft.index');
        Route::get('/data-skkft', [ApproveSkkftController::class, 'ajaxIndexData'])->name('dataSkkft.data');
        Route::get('/data-skkft-show/{id}', [ApproveSkkftController::class, 'showKegiatan'])->name('skkft.show');
        Route::get('/approve-skkft/{id}', [ApproveSkkftController::class, 'edit'])->name('approveKegiatan.edit');
        Route::post('/update-skkft/{id}', [ApproveSkkftController::class, 'update'])->name('approveKegiatan.update');
        Route::delete('/delete-skkft/{id}', [ApproveSkkftController::class, 'delete'])->name('approveKegiatan.destroy'); 
        Route::get('/skpi-print/{id}', [SkpiController::class, 'print'])->name('skpi.print');
        Route::get('/skpi-edit/{id}', [SkpiController::class, 'edit'])->name('skpi.edit');
        Route::put('/skpi-update/{id}', [SkpiController::class, 'update'])->name('skpi.update');
    });
    
    // SKKFT ADMIN dan DOSEN
    Route::group(['middleware' => 'ceklevel:1,2'], function(){
        Route::get('/skpi-list', [SkpiController::class, 'list'])->name('skpi.list');
        Route::get('/skpi-list/data', [SkpiController::class, 'datalist'])->name('skpi.data');
    });
    
    // SKKFT DOSEN
    Route::group(['middleware'=>'ceklevel:2'], function(){
        Route::get('/sertifikat', [SertifikatSkkftController::class, 'index'])->name('sertifikat.index');
        Route::get('/sertifikat-show/{id}', [SertifikatSkkftController::class, 'show'])->name('sertifikat.show');
        Route::post('/sertifikat/{id}', [SertifikatSkkftController::class, 'verify'])->name('sertifikat.verify');
        Route::post('/sertifikat-reject/{id}', [SertifikatSkkftController::class, 'reject'])->name('sertifikat.reject');
        Route::get('/skpi', [SkpiController::class, 'index'])->name('skpi.index');
        Route::post('/skpi/{id}', [SkpiController::class, 'verify'])->name('skpi.verify');
        Route::get('/skpi-show/{id}', [SkpiController::class, 'show'])->name('skpi.show');
        Route::put('/kegiatan-skpi-delete/{id}', [SkpiController::class, 'deleteKegiatan'])->name('skpi.deleteKegiatan');
    });

    // SKKFT MAHASISWA
    Route::group(['middleware' => 'ceklevel:3'], function(){
        Route::resource('/kegiatan', KegiatanSkkftController::class);
        Route::get('/kegiatan-claim', [ClaimSkkftController::class, 'claimKegiatan'])->name('kegiatan.claim');
        Route::get('/kegiatan-summary-data', [KegiatanSkkftController::class, 'dataSkkft'])->name('kegiatan.data');
        Route::get('/kegiatan-summary', [KegiatanSkkftController::class, 'summary'])->name('kegiatan.summary');
        Route::post('/sertifikat-store', [SertifikatSkkftController::class, 'store'])->name('sertifikat.store');
        Route::post('/skpi-store', [SkpiController::class, 'store'])->name('skpi.store');
        Route::get('/sertifikat-skkft-generate', [KegiatanSkkftController::class, 'generateSkkft'])->name('sertifikatSkkft.generate');
    });

});


Route::group(['prefix' => '/dokumentasi_sidang'], function () {
    // Dokumentasi Sidang Role MAHASISWA
    Route::group(['middleware' => 'ceklevel:3'], function () {
        // Daftar Seminar Tugas Akhir Mahasiswa TI
        Route::get('seminar/ti', [DaftarSeminarController::class, 'indexTi'])->name('seminar_ti.index');
        Route::get('daftar/seminar/ti', [DaftarSeminarController::class, 'daftarTi'])->name('seminar_ti.daftar');
        Route::post('store/seminar/ti', [DaftarSeminarController::class, 'storeTi'])->name('seminar_ti.store');
        Route::get('edit/seminar/ti/{id}', [DaftarSeminarController::class, 'editTi'])->name('seminar_ti.edit');
        Route::post('update/seminar/ti/{id}', [DaftarSeminarController::class, 'updateTi'])->name('seminar_ti.update');
        Route::get('show/seminar/ti/{id}', [DaftarSeminarController::class, 'showTi'])->name('seminar_ti.show');
        // Daftar Kolokium Skripsi Mahasiswa TAMBANG
        Route::get('seminar/tmb', [DaftarSeminarController::class, 'indexTmb'])->name('seminar_tmb.index');
        Route::get('daftar/seminar/tmb', [DaftarSeminarController::class, 'daftarTmb'])->name('seminar_tmb.daftar');
        Route::post('store/seminar/tmb', [DaftarSeminarController::class, 'storeTmb'])->name('seminar_tmb.store');
        Route::get('edit/seminar/tmb/{id}', [DaftarSeminarController::class, 'editTmb'])->name('seminar_tmb.edit');
        Route::post('update/seminar/tmb/{id}', [DaftarSeminarController::class, 'updateTmb'])->name('seminar_tmb.update');
        Route::get('show/seminar/tmb/{id}', [DaftarSeminarController::class, 'showTmb'])->name('seminar_tmb.show');
        // Daftar Sidang Pembahasan Mahasiswa PWK
        Route::get('seminar/pwk', [DaftarSeminarController::class, 'indexPwk'])->name('seminar_pwk.index');
        Route::get('daftar/seminar/pwk', [DaftarSeminarController::class, 'daftarPwk'])->name('seminar_pwk.daftar');
        Route::post('store/seminar/pwk', [DaftarSeminarController::class, 'storePwk'])->name('seminar_pwk.store');
        Route::get('edit/seminar/pwk/{id}', [DaftarSeminarController::class, 'editPwk'])->name('seminar_pwk.edit');
        Route::post('update/seminar/pwk/{id}', [DaftarSeminarController::class, 'updatePwk'])->name('seminar_pwk.update');
        Route::get('show/seminar/pwk/{id}', [DaftarSeminarController::class, 'showPwk'])->name('seminar_pwk.show');
        // Daftar Sidang Skripsi Mahasiswa TAMBANG
        Route::get('sidang/tmb', [DaftarSidangController::class, 'indexTmb'])->name('sidang_tmb.index');
        Route::get('daftar/sidang/tmb', [DaftarSidangController::class, 'daftarTmb'])->name('sidang_tmb.daftar');
        Route::post('store/sidang/tmb', [DaftarSidangController::class, 'storeTmb'])->name('sidang_tmb.store');
        Route::get('edit/sidang/tmb/{id}', [DaftarSidangController::class, 'editTmb'])->name('sidang_tmb.edit');
        Route::post('update/sidang/tmb/{id}', [DaftarSidangController::class, 'updateTmb'])->name('sidang_tmb.update');
        Route::get('show/sidang/tmb/{id}', [DaftarSidangController::class, 'showTmb'])->name('sidang_tmb.show');
        // Daftar Sidang Tugas Akhir Mahasiswa TI
        Route::get('sidang/ti', [DaftarSidangController::class, 'indexTi'])->name('sidang_ti.index');
        Route::get('daftar/sidang/ti', [DaftarSidangController::class, 'daftarTi'])->name('sidang_ti.daftar');
        Route::post('store/sidang/ti', [DaftarSidangController::class, 'storeTi'])->name('sidang_ti.store');
        Route::get('edit/sidang/ti/{id}', [DaftarSidangController::class, 'editTi'])->name('sidang_ti.edit');
        Route::post('update/sidang/ti/{id}', [DaftarSidangController::class, 'updateTi'])->name('sidang_ti.update');
        Route::get('show/sidang/ti/{id}', [DaftarSidangController::class, 'showTi'])->name('sidang_ti.show');
        // Daftar Sidang Terbuka Mahasiswa PWK
        Route::get('sidang/pwk', [DaftarSidangController::class, 'indexPwk'])->name('sidang_pwk.index');
        Route::get('daftar/sidang/pwk', [DaftarSidangController::class, 'daftarPwk'])->name('sidang_pwk.daftar');
        Route::post('store/sidang/pwk', [DaftarSidangController::class, 'storePwk'])->name('sidang_pwk.store');
        Route::get('edit/sidang/pwk/{id}', [DaftarSidangController::class, 'editPwk'])->name('sidang_pwk.edit');
        Route::post('update/sidang/pwk/{id}', [DaftarSidangController::class, 'updatePwk'])->name('sidang_pwk.update');
        Route::get('show/sidang/pwk/{id}', [DaftarSidangController::class, 'showPwk'])->name('sidang_pwk.show');
    });
    
    // Dokumentasi Sidang Role DOSEN
    Route::group(['middleware' => 'ceklevel:2'], function () {
        // Approval dan export data Kolokium Skripsi TAMBANG
        Route::get('view-seminar/tmb', [ApproveSeminarController::class, 'viewTmb'])->name('view-seminarTmb.index');
        Route::get('view-seminar/tmb/data', [ApproveSeminarController::class, 'dataTmb'])->name('view-seminarTmb.data');
        Route::match(['get', 'post'], '/approval-seminar/tmb/{id}', [ApproveSeminarController::class, 'approveTmb'])->name('approve-seminarTmb.store');
        Route::get('rekap-seminar/tmb', [ApproveSeminarController::class, 'rekapTmb'])->name('rekap-seminarTmb.index');
        Route::get('rekap-seminar/tmb/data', [ApproveSeminarController::class, 'dataRekapTmb'])->name('rekap-seminarTmb.data');
        Route::get('show-seminar/tmb/{id}', [ApproveSeminarController::class, 'showRekapTmb'])->name('rekap-seminarTmb.show');
        Route::get('excel-export-seminar/tmb', [ApproveSeminarController::class, 'exportExcelTmb'])->name('seminarTmbExcel.export');
        Route::get('pdf-export-seminar/tmb', [ApproveSeminarController::class, 'exportPdfTmb'])->name('seminarTmbPdf.export');
        // Approval dan export data Seminar Tugas Akhir TI
        Route::get('view-seminar/ti', [ApproveSeminarController::class, 'viewTi'])->name('view-seminarTi.index');
        Route::get('view-seminar/ti/data', [ApproveSeminarController::class, 'dataTi'])->name('view-seminarTi.data');
        Route::match(['get', 'post'], '/approval-seminar/ti/{id}', [ApproveSeminarController::class, 'approveTi'])->name('approve-seminarTi.store');
        Route::get('rekap-seminar/ti', [ApproveSeminarController::class, 'rekapTi'])->name('rekap-seminarTi.index');
        Route::get('rekap-seminar/ti/data', [ApproveSeminarController::class, 'dataRekapTi'])->name('rekap-seminarTi.data');
        Route::get('show-seminar/ti/{id}', [ApproveSeminarController::class, 'showRekapTi'])->name('rekap-seminarTi.show');
        Route::get('excel-export-seminar/ti', [ApproveSeminarController::class, 'exportExcelTi'])->name('seminarTiExcel.export');
        Route::get('pdf-export-seminar/ti', [ApproveSeminarController::class, 'exportPdfTi'])->name('seminarTiPdf.export');
        // Approval dan export data Sidang Pembahasan PWK
        Route::get('view-seminar/pwk', [ApproveSeminarController::class, 'viewPwk'])->name('view-seminarPwk.index');
        Route::get('view-seminar/pwk/data', [ApproveSeminarController::class, 'dataPwk'])->name('view-seminarPwk.data');
        Route::match(['get', 'post'], '/approval-seminar/pwk/{id}', [ApproveSeminarController::class, 'approvePwk'])->name('approve-seminarPwk.store');
        Route::get('rekap-seminar/pwk', [ApproveSeminarController::class, 'rekapPwk'])->name('rekap-seminarPwk.index');
        Route::get('rekap-seminar/pwk/data', [ApproveSeminarController::class, 'dataRekapPwk'])->name('rekap-seminarPwk.data');
        Route::get('show-seminar/pwk/{id}', [ApproveSeminarController::class, 'showRekapPwk'])->name('rekap-seminarPwk.show');
        Route::get('excel-export-seminar/pwk', [ApproveSeminarController::class, 'exportExcelPwk'])->name('seminarPwkExcel.export');
        Route::get('pdf-export-seminar/pwk', [ApproveSeminarController::class, 'exportPdfPwk'])->name('seminarPwkPdf.export');
        // Approval dan export data Sidang Skripsi TAMBANG
        Route::get('view-sidang/tmb', [ApproveSidangController::class, 'viewTmb'])->name('view-sidangTmb.index');
        Route::get('view-sidang/tmb/data', [ApproveSidangController::class, 'dataTmb'])->name('view-sidangTmb.data');
        Route::match(['get', 'post'], '/approval-sidang/tmb/{id}', [ApproveSidangController::class, 'approveTmb'])->name('approve-sidangTmb.store');
        Route::get('rekap-sidang/tmb', [ApproveSidangController::class, 'rekapTmb'])->name('rekap-sidangTmb.index');
        Route::get('rekap-sidang/tmb/data', [ApproveSidangController::class, 'dataRekapTmb'])->name('rekap-sidangTmb.data');
        Route::get('show-sidang/tmb/{id}', [ApproveSidangController::class, 'showRekapTmb'])->name('rekap-sidangTmb.show');
        Route::get('excel-export-sidang/tmb', [ApproveSidangController::class, 'exportExcelTmb'])->name('sidangTmbExcel.export');
        Route::get('pdf-export-sidang/tmb', [ApproveSidangController::class, 'exportPdfTmb'])->name('sidangTmbPdf.export');
        // Approval dan export data Sidang Tugas Akhir TI
        Route::get('view-sidang/ti', [ApproveSidangController::class, 'viewTi'])->name('view-sidangTi.index');
        Route::get('view-sidang/ti/data', [ApproveSidangController::class, 'dataTi'])->name('view-sidangTi.data');
        Route::match(['get', 'post'], '/approval-sidang/ti/{id}', [ApproveSidangController::class, 'approveTi'])->name('approve-sidangTi.store');
        Route::get('rekap-sidang/ti', [ApproveSidangController::class, 'rekapTi'])->name('rekap-sidangTi.index');
        Route::get('rekap-sidang/ti/data', [ApproveSidangController::class, 'dataRekapTi'])->name('rekap-sidangTi.data');
        Route::get('show-sidang/ti/{id}', [ApproveSidangController::class, 'showRekapTi'])->name('rekap-sidangTi.show');
        Route::get('excel-export-sidang/ti', [ApproveSidangController::class, 'exportExcelTi'])->name('sidangTiExcel.export');
        Route::get('pdf-export-sidang/ti', [ApproveSidangController::class, 'exportPdfTi'])->name('sidangTiPdf.export');
        // Approval dan export data Sidang Terbuka PWK
        Route::get('view-sidang/pwk', [ApproveSidangController::class, 'viewPwk'])->name('view-sidangPwk.index');
        Route::get('view-sidang/pwk/data', [ApproveSidangController::class, 'dataPwk'])->name('view-sidangPwk.data');
        Route::match(['get', 'post'], '/approval-sidang/pwk/{id}', [ApproveSidangController::class, 'approvePwk'])->name('approve-sidangPwk.store');
        Route::get('rekap-sidang/pwk', [ApproveSidangController::class, 'rekapPwk'])->name('rekap-sidangPwk.index');
        Route::get('rekap-sidang/pwk/data', [ApproveSidangController::class, 'dataRekapPwk'])->name('rekap-sidangPwk.data');
        Route::get('show-sidang/pwk/{id}', [ApproveSidangController::class, 'showRekapPwk'])->name('rekap-sidangPwk.show');
        Route::get('excel-export-sidang/pwk', [ApproveSidangController::class, 'exportExcelPwk'])->name('sidangPwkExcel.export');
        Route::get('pdf-export-sidang/pwk', [ApproveSidangController::class, 'exportPdfPwk'])->name('sidangPwkPdf.export');
        // View data Mahasiswa Bimbingan TMB, TI, PWK
        Route::get('data-bimbingan/tmb', [BimbinganController::class, 'indexTmb'])->name('bimbinganTmb.index');
        Route::get('data-bimbingan/tmb-data-1', [BimbinganController::class, 'dataTmb1'])->name('bimbinganTmb.data1');
        Route::get('data-bimbingan/tmb-data-2', [BimbinganController::class, 'dataTmb2'])->name('bimbinganTmb.data2');
        Route::get('data-bimbingan/{id}/tmb-show-1', [BimbinganController::class, 'showTmb1'])->name('bimbinganTmb.showTmb1');
        Route::get('data-bimbingan/{id}/tmb-show-2', [BimbinganController::class, 'showTmb2'])->name('bimbinganTmb.showTmb2');
        Route::get('data-bimbingan/ti', [BimbinganController::class, 'indexTi'])->name('bimbinganTi.index');
        Route::get('data-bimbingan/ti-data-1', [BimbinganController::class, 'dataTi1'])->name('bimbinganTi.data1');
        Route::get('data-bimbingan/ti-data-2', [BimbinganController::class, 'dataTi2'])->name('bimbinganTi.data2');
        Route::get('data-bimbingan/{id}/ti-show-1', [BimbinganController::class, 'showTi1'])->name('bimbinganTi.showTi1');
        Route::get('data-bimbingan/{id}/ti-show-2', [BimbinganController::class, 'showTi2'])->name('bimbinganTi.showTi2');
        Route::get('data-bimbingan/pwk', [BimbinganController::class, 'indexPwk'])->name('bimbinganPwk.index');
        Route::get('data-bimbingan/pwk-data-1', [BimbinganController::class, 'dataPwk1'])->name('bimbinganPwk.data1');
        Route::get('data-bimbingan/pwk-data-2', [BimbinganController::class, 'dataPwk2'])->name('bimbinganPwk.data2');
        Route::get('data-bimbingan/{id}/pwk-show-1', [BimbinganController::class, 'showPwk1'])->name('bimbinganPwk.showPwk1');
        Route::get('data-bimbingan/{id}/pwk-show-2', [BimbinganController::class, 'showPwk2'])->name('bimbinganPwk.showPwk2');
    });

    // Dokumentasi Sidang Role ADMIN dan DOSEN
    Route::group(['middleware' => 'ceklevel:1,2'], function(){
        Route::get('rekap-seminar/tmb/dwnld', [DownloadSeminarController::class, 'indexTmb'])->name('seminarTmbDownload.index');
        Route::get('rekap-seminar/tmb/dwnld/data', [DownloadSeminarController::class, 'dataTmb'])->name('seminarTmbDownload.data');
        Route::get('rekap-seminar/ti/dwnld', [DownloadSeminarController::class, 'indexTi'])->name('seminarTiDownload.index');
        Route::get('rekap-seminar/ti/dwnld/data', [DownloadSeminarController::class, 'dataTi'])->name('seminarTiDownload.data');
        Route::get('rekap-seminar/pwk/dwnld', [DownloadSeminarController::class, 'indexPwk'])->name('seminarPwkDownload.index');
        Route::get('rekap-seminar/pwk/dwnld/data', [DownloadSeminarController::class, 'dataPwk'])->name('seminarPwkDownload.data');
        Route::get('rekap-seminar/pwk/{id}/dwnld', [DownloadSeminarController::class, 'downloadPwk'])->name('downloadPwk');

        Route::get('rekap-sidang/tmb/dwnld', [DownloadSidangController::class, 'indexTmb'])->name('sidangTmbDownload.index');
        Route::get('rekap-sidang/tmb/dwnld/data', [DownloadSidangController::class, 'dataTmb'])->name('sidangTmbDownload.data');
        Route::get('rekap-sidang/ti/dwnld', [DownloadSidangController::class, 'indexTi'])->name('sidangTiDownload.index');
        Route::get('rekap-sidang/ti/dwnld/data', [DownloadSidangController::class, 'dataTi'])->name('sidangTiDownload.data');
        Route::get('rekap-sidang/pwk/dwnld', [DownloadSidangController::class, 'indexPwk'])->name('sidangPwkDownload.index');
        Route::get('rekap-sidang/pwk/dwnld/data', [DownloadSidangController::class, 'dataPwk'])->name('sidangPwkDownload.data');
    });

});

// ARSIP Fakultas Role ADMIN, DOSEN
Route::group(['prefix' => '/archives'], function () {

    Route::group(['middleware' => 'ceklevel:1'], function () {
        // CRUD ARCHIVE
        Route::resource('ft-arsip', ArchiveController::class)->except('destroy');
        Route::get('ft-arsip/{id}/destroy', [ArchiveController::class, 'destroy'])->name('ft-arsip.destroy');
        Route::get('data/ft-arsip', [ArchiveController::class, 'data'])->name('ft-arsip.data');

        // download Archive
        Route::get('download/{id}/ft-arsip', [ArchiveController::class, 'downloadFile'])->name('ft-arsip.download');

        Route::get('general', [ArchiveController::class, 'indexGeneral'])->name('ft-arsip.general');
        Route::get('data-general', [ArchiveController::class, 'dataGeneral'])->name('ft-arsip-general.data');
    });

    Route::group(['middleware' => 'ceklevel:2'], function () {
        // ARSIP Fakultas Role DOSEN
        Route::get('all-archive', [MyArchiveController::class, 'indexArchive'])->name('all-archive.index');
        Route::get('all-archive/data', [MyArchiveController::class, 'indexDataArchive'])->name('all-archive.data');
        Route::get('my-archive', [MyArchiveController::class, 'myArchive'])->name('my-archive.index');
        Route::get('my-archive/data', [MyArchiveController::class, 'myDataArchive'])->name('my-archive.data');
        Route::get('my-archive/{id}/add', [MyArchiveController::class, 'addArchive'])->name('my-archive.add');
        Route::get('my-archive/create', [MyArchiveController::class, 'createArchive'])->name('my-archive.create');
        Route::get('my-archive/show/{id}', [MyArchiveController::class, 'showArchive'])->name('my-archive.show');
        Route::post('my-archive/store', [MyArchiveController::class, 'storeArchive'])->name('my-archive.store');
        Route::get('my-archive/{id}/edit', [MyArchiveController::class, 'editArchive'])->name('my-archive.edit');
        Route::put('my-archive/{id}/update', [MyArchiveController::class, 'updateArchive'])->name('my-archive.update');
        Route::get('my-archive/{id}/delete', [MyArchiveController::class, 'deleteArchive'])->name('my-archive.destroy');
        Route::get('generals', [MyArchiveController::class, 'indexGeneral'])->name('my-archive.general');
        Route::get('data-generals', [MyArchiveController::class, 'dataGeneral'])->name('my-archive-general.data');
        Route::get('download/{id}/my-archive', [MyArchiveController::class, 'downloadFile'])->name('my-archive.download');
        Route::match(['get', 'post'], 'my-archive/download-selected', [MyArchiveController::class, 'downloadSelected'])->name('myarchive.downloadselected');
    });

    Route::get('dropdownlist/category-archive/{id}', [CategoryArsipController::class, 'getDataCategory'])->name('get-category.data');
    Route::get('dropdownlist/sub-category-archive/{id}', [SubcategoryArsipController::class, 'getDataSubcategory'])->name('get-subcategory.data');
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
