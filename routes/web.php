<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Admin\DataLkps;
use App\Http\Controllers\Admin\JenisBab;
use App\Http\Controllers\Admin\JenisSubBab;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\LembagaUnuja;
use App\Http\Controllers\Lp2m\MonitoringLed;
use App\Http\Controllers\Admin\JenisKriteria;
use App\Http\Controllers\Admin\SebaranBorang;
use App\Http\Controllers\Lp2m\MonitoringLkps;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\DetailKriteria;
use App\Http\Controllers\Admin\HasilMonitoring;
use App\Http\Controllers\Prodi\UploadLkpsProdi;
use App\Http\Controllers\Admin\JenisSubKriteria;
use App\Http\Controllers\Prodi\HasilReviewProdi;
use App\Http\Controllers\Admin\DokumenAkreditasi;
use App\Http\Controllers\Admin\LembagaAkreditasi;
use App\Http\Controllers\Lembaga\HasilReviewLembaga;
use App\Http\Controllers\Prodi\SebaranPengajuanProdi;
use App\Http\Controllers\Prodi\PengajuanAkreditasiProdi;
use App\Http\Controllers\Admin\DetailPengajuanAkreditasi;
use App\Http\Controllers\Lembaga\PengajuanAkreditasiLembaga;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        // 'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::group(['middleware' => 'auth'], function() {
    Route::inertia('/udashboard', 'uDashboard')->name('udashboard');

    Route::get("/", [RedirectAuthenticatedUsersController::class, "home"]);

    Route::group(['middleware' => 'cekAkun:admin'], function() {
        Route::get('/Dashboard', [AdminDashboard::class, 'index'])->name('adminDashboard');

        // Lembaga Akreditasi
        Route::resource('/data-lembaga-akreditasi', LembagaAkreditasi::class);

        Route::get('/data-lembaga-akreditasi/{id_lembaga_akreditasi}/update_status', [LembagaAkreditasi::class, 'editStatus'])->name('data-lembaga-akreditasi.editStatus');
        
        Route::post('/data-lembaga-akreditasi/{id_lembaga_akreditasi}/update_status', [LembagaAkreditasi::class, 'updateStatus'])->name('data-lembaga-akreditasi.updateStatus');
        // Akhir Lembaga Akreditasi


        // Lembaga Unuja
        Route::resource('/data-lembaga-unuja', LembagaUnuja::class);

        Route::get('/data-lembaga-unuja/{id_lembaga}/update_status', [LembagaUnuja::class, 'editStatus'])->name('data-lembaga-unuja.editStatus');
        
        Route::post('/data-lembaga-unuja/{id_lembaga}/update_status', [LembagaUnuja::class, 'updateStatus'])->name('data-lembaga-unuja.updateStatus');
        // Akhir Lembaga Unuja


        // Jenis BAB
        Route::resource('/data-jenis-bab', JenisBab::class);
        
        Route::get('/data-jenis-bab/{id_bab}/update_status', [JenisBab::class, 'editStatus'])->name('data-jenis-bab.editStatus');
        
        Route::post('/data-jenis-bab/{id_bab}/update_status', [JenisBab::class, 'updateStatus'])->name('data-jenis-bab.updateStatus');
        // Akhir Jenis BAB


        // Sub Bab
        Route::resource('/data-jenis-sub-bab', JenisSubBab::class);

        Route::post('/get-babs', [JenisSubBab::class, 'getBabs'])->name('get-babs');

        Route::get('/data-jenis-sub-bab/{id_sub_bab}/update_status', [JenisSubBab::class, 'editStatus'])->name('data-jenis-sub-bab.editStatus');
        
        Route::post('/data-jenis-sub-bab/{id_sub_bab}/update_status', [JenisSubBab::class, 'updateStatus'])->name('data-jenis-sub-bab.updateStatus');
        // Akhir Sub Bab


        // Kriteria
        Route::resource('/data-jenis-kriteria', JenisKriteria::class);

        
        Route::post('/babs-kriteria', [JenisKriteria::class, 'getBabs'])->name('bab-kriteria');

        Route::post('/sub-babs-kriteria', [JenisKriteria::class, 'getSubBabs'])->name('subbab-kriteria');
        
        Route::get('/data-jenis-kriteria/{id_kriteria}/update_status', [JenisKriteria::class, 'editStatus'])->name('data-jenis-kriteria.editStatus');
        
        Route::post('/data-jenis-kriteria/{id_kriteria}/update_status', [JenisKriteria::class, 'updateStatus'])->name('data-jenis-kriteria.updateStatus');
        // Akhir Kriteria


        // Sub Kriteria
        Route::resource('/data-jenis-sub-kriteria', JenisSubKriteria::class);

        Route::post('/babs-sub-kriteria', [JenisSubKriteria::class, 'getBab'])->name('babs-sub-kriteria');

        Route::post('/sub-kriteri-subbabs', [JenisSubKriteria::class, 'getSubBab'])->name('sub-bab-kriteria');
        
        Route::post('/kriteria-subkriteria', [JenisSubKriteria::class, 'getKriteria'])->name('kriteria-subkriteria');
        
        Route::get('/data-jenis-sub-kriteria/{id_sub_kriteria}/update_status', [JenisSubKriteria::class, 'editStatus'])->name('data-jenis-sub-kriteria.editStatus');
        
        Route::post('/data-jenis-sub-kriteria/{id_sub_kriteria}/update_status', [JenisSubKriteria::class, 'updateStatus'])->name('data-jenis-sub-kriteria.updateStatus');
        // Akhir Sub Kriteria


        // Monitoring LKPS
        Route::get('/monitoring-lkps', [MonitoringLkps::class, 'index'])->name('monitoring-lkps.index');

        Route::get('/nilai-monitoring-lkps/kC7mbZLMEia93OVf{id_pengajuan_lkps}BZTmh8.TCyUd', [MonitoringLkps::class, 'getLkps'])->name('monitoring-lkps.getLkps');

        Route::post('/simpan-nilai-lkps/v29DJti4iyHwKAc{id_pengajuan_lkps}JZHsEkxBLhdlX', [MonitoringLkps::class, 'nilaiLkps'])->name('monitoring-lkps.nilaiLksp');
        // Akhir Monitoring LKPS

        // Monitoring LED
        Route::get('/monitoring-led', [MonitoringLed::class, 'index'])->name('monitoring-led.index');

        Route::get('/detail-monitoring-led/XGuHRseFbdpoxBonv5{id_pengajuan}89lMFbNGUBTntTl', [MonitoringLed::class, 'detail'])->name('monitoring-led.detail');

        Route::get('/cek-dokumen-akreditasi/yjkfRh7oEwj7b{id_detail_pengajuan}3dL1ei/GNExhp8U', [MonitoringLed::class, 'penilaian'])->name('monitoring-led.dokumen');

        Route::get('/nilai-monitoring-led/khygvbnTd45{id_pengajuan}PHgfrtCE4qw', [MonitoringLed::class, 'nilaiPengajuan'])->name('monitoring-led.nilaiPengajuan');

        Route::post('/nilai-monitoring-led/khygvbnTd45{id_pengajuan}PHgfrtCE4qw', [MonitoringLed::class, 'simpanNilai'])->name('monitoring-led.simpanNilai');
        //Akhir Menu LP2M

        // Daftar Dokumen Akreditasi
        Route::get('/data-dokumen-akreditasi', [DokumenAkreditasi::class, 'daftarDokumen'])->name('daftarDokumen');
    });


    Route::group(['middleware' => 'cekAkun:kaprodi'], function() {
        Route::inertia('/kaprodiDashboard', 'Kaprodi/KaprodiDashboard')->name('kaprodiDashboard');

        // Pengajuan Akreditasi
        Route::resource('/pengajuan-akreditasi-prodi', SebaranBorang::class);
        // Akhir Pengajuan Akreditasi


        // Detail Pengajuan Akreditasi
        Route::get('/pengajuan-akreditasi-prodi/Zdo9k1lysUiwHuKn{id_pengajuan}Dxs2oXPIGi/detail', [SebaranBorang::class, 'detailPengajuan'])->name('pengajuan-akreditasi-prodi.detailPengajuan');


        // Route for page detail pengajuan akreditasi
        Route::post('/deskripsi-babs', [SebaranBorang::class, 'getDeskripsi'])->name('deskripsi-babs');
        Route::post('/sub-babs', [SebaranBorang::class, 'getSubBabs'])->name('sub-babs');
        Route::post('/kriteria', [SebaranBorang::class, 'getKriteria'])->name('kriteria');
        Route::post('/sub-kriteria', [SebaranBorang::class, 'getSubKriteria'])->name('sub-kriteria');
        // Akhir Route Page Detail Pengajuan Akreditasi


        // Simpan Detail Pengajuan Akreditasi
        Route::post('/tambah-detail-pengajuan-baru', [DetailPengajuanAkreditasi::class, 'tambahDetailPengajuan'])->name('tambah-detail-pengajuan-baru.tambahDetailPengajuan');


        // Route Page Upload Dokumen Akreditasi
        Route::get('/upload-dokumen-akreditasi/3jy4h6n8m3{id_detail_pengajuan}p0c13x/prodi', [PengajuanAkreditasiProdi::class, 'uploadDokumen'])->name('pengajuan-akreditasi-prodi.uploadDokumen');

        Route::post('/upload-dokumen-akreditasi-prodi', [PengajuanAkreditasiProdi::class, 'SimpanDokumen'])->name('pengajuan-akreditasi-prodi.Simpan');
        // Akhir Detail Pengajuan Akreditasi


        // Update Akses Dokumen Akreditasi
        Route::get('/dokumen-akreditasi/5b1nms38zz{id_dokumen}8q0r2y/update_akses', [DokumenAkreditasi::class, 'editAkses'])->name('pengajuan-akreditasi-prodi.editAkses');

        Route::post('/dokumen-akreditasi/5b1nms38zz{id_dokumen}8q0r2y/update_akses', [DokumenAkreditasi::class, 'updateAkses'])->name('pengajuan-akreditasi-prodi.updateAkses');

        // Sebaran Pengajuan
        Route::get('/sebaran-pengajuan-prodi', [SebaranPengajuanProdi::class, 'index'])->name('sebaran-pengajuan-prodi.index');


        // Hasil Review
        Route::get('/hasil-review-prodi', [HasilReviewProdi::class, 'index'])->name('hasil-review-prodi.index');


        // Upload LKPS
        Route::get('/upload-lkps-prodi', [UploadLkpsProdi::class, 'index'])->name('upload-lkps-prodi.index');
        
        Route::post('/upload-berkas-lkps-prodi', [UploadLkpsProdi::class, 'store'])->name('upload-lkps-prodi.store');

        Route::get('/upload-berkas-lkps-prodi/RMslre3M9qEym{id_pengajuan_lkps}4WBRLv4AoZ/update_akses', [UploadLkpsProdi::class, 'editAkses'])->name('upload-lkps-prodi.editAksesDokumen');

        Route::post('/upload-berkas-lkps-prodi/RMslre3M9qEym{id_pengajuan_lkps}4WBRLv4AoZ/update_akses', [UploadLkpsProdi::class, 'updateAkses'])->name('upload-lkps-prodi.updateAksesDokumen');


        // Daftar Dokumen
        Route::get('/data-dokumen-akreditasi-dan-dokumen-lkps', [DokumenAkreditasi::class, 'readDok'])->name('dokAkreditasiLKPS.index');
    });


    Route::group(['middleware' => 'cekAkun:lembaga'], function() {
        Route::inertia('/lembagaDashboard', 'Lembaga/LembagaDashboard')->name('lembagaDashboard');

        // Pengajuan Akreditasi
        Route::get('/daftar-prodi', [PengajuanAkreditasiLembaga::class, 'index'])->name('pengajuan-akreditasi-lembaga.index');

        Route::get('/pengajuan-akreditasi-prodi/y$10$YHn{id_lembaga}6lEhR/cek', [PengajuanAkreditasiLembaga::class, 'detail'])->name('pengajuan-akreditasi-lembaga.pengajuanAkreditasi');

        Route::get('/detail-pengajuan-akreditasi/Njeu7O82cJqOcYv3oOu{id_pengajuan}CHrgPdzjEG3vn6Y', [PengajuanAkreditasiLembaga::class, 'detailPengajuan'])->name('pengajuan-akreditasi-lembaga.detailPengajuan');

        Route::get('/cek-dokumen-akreditasi/NBrm00f7EJFeQ{id_detail_pengajuan}dwcScY3DLl81Z', [PengajuanAkreditasiLembaga::class, 'showDokumen'])->name('pengajuan-akreditasi-lembaga.showDokumen');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
