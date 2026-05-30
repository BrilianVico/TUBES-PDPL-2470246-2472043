    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AdminAuthController;
    use App\Http\Controllers\OrtuAuthController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\DataSiswaController;
    use App\Http\Controllers\TagihanController;
    use App\Http\Controllers\BeasiswaController;
    use App\Http\Controllers\PengumumanController;
    use App\Http\Controllers\PembayaranController;
    use App\Http\Controllers\DashboardOrtuController;
    use App\Http\Controllers\OrtuTagihanController;
    use App\Http\Controllers\OrtuBeasiswaController;

    /*
    |--------------------------------------------------------------------------
    | Public Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/', function () {
        return view('auth.landing');
    })->name('home');

    Route::get('/login-menu', function () {
        return view('auth.pilih-login');
    })->name('login.menu');

    Route::get('/register-sekolah', function () {
        return view('auth.register-sekolah');
    })->name('register.sekolah');

    /*
    |--------------------------------------------------------------------------
    | Admin Authentication
    |--------------------------------------------------------------------------
    */

    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('login.process');

    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Orang Tua Authentication
    |--------------------------------------------------------------------------
    */

    Route::get('/login-ortu', [OrtuAuthController::class, 'showLoginForm'])
        ->name('login.ortu');

    Route::post('/login-ortu', [OrtuAuthController::class, 'login'])
        ->name('login.ortu.process');

    Route::post('/logout-ortu', [OrtuAuthController::class, 'logout'])
        ->name('logout.ortu');

    /*
    |--------------------------------------------------------------------------
    | Cek Akun Orang Tua
    |--------------------------------------------------------------------------
    */

    Route::get('/ortu/cek-akun', [OrtuAuthController::class, 'showCekAkun'])
        ->name('ortu.cek-akun');

    Route::post('/ortu/cek-akun', [OrtuAuthController::class, 'cekAkun'])
        ->name('ortu.cek-akun.process');

    /*
    |--------------------------------------------------------------------------
    | Lupa Password Orang Tua (sebelum login)
    |--------------------------------------------------------------------------
    */

    Route::get('/ortu/lupa-password', [OrtuAuthController::class, 'showForgotPassword'])
        ->name('ortu.forgot-password');

    Route::post('/ortu/lupa-password', [OrtuAuthController::class, 'resetPassword'])
        ->name('ortu.forgot-password.process');

    /*
    |--------------------------------------------------------------------------
    | Protected Routes - Admin
    |--------------------------------------------------------------------------
    */

    Route::middleware('admin.auth')->group(function () {
        // Pengajuan Beasiswa
        Route::get(
            '/admin/pengajuan-beasiswa',
            [BeasiswaController::class, 'pengajuan']
        )->name('admin.pengajuan.index');

        Route::post(
            '/admin/pengajuan-beasiswa/{id}/approve',
            [BeasiswaController::class, 'approvePengajuan']
        )->name('admin.pengajuan.approve');

        Route::post(
            '/admin/pengajuan-beasiswa/{id}/reject',
            [BeasiswaController::class, 'rejectPengajuan']
        )->name('admin.pengajuan.reject');


        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Data Master Siswa
        Route::get('/admin/data-siswa', [DataSiswaController::class, 'index'])
            ->name('admin.data-siswa');

        // CRUD Tagihan
        Route::resource('admin/tagihan', TagihanController::class)
            ->names('admin.tagihan');

        // CRUD Beasiswa
        Route::resource('admin/beasiswa', BeasiswaController::class)
            ->names('admin.beasiswa');

        // CRUD Pengumuman
        Route::resource('admin/pengumuman', PengumumanController::class)
            ->names('admin.pengumuman');

        // Data Pembayaran
        Route::get('/admin/pembayaran', [PembayaranController::class, 'index'])
            ->name('admin.pembayaran.index');

        // Approve pembayaran
        Route::post('/admin/pembayaran/{id}/approve', [PembayaranController::class, 'approve'])
            ->name('admin.pembayaran.approve');

        // Reject pembayaran
        Route::post('/admin/pembayaran/{id}/reject', [PembayaranController::class, 'reject'])
            ->name('admin.pembayaran.reject');
    });

    /*
    |--------------------------------------------------------------------------
    | Protected Routes - Orang Tua
    |--------------------------------------------------------------------------
    */

    Route::middleware('ortu.auth')->group(function () {

        // Dashboard Orang Tua
        Route::get('/dashboard-ortu', [DashboardOrtuController::class, 'index'])
            ->name('dashboard.ortu');

        // Ubah Password
        Route::get('/ortu/ubah-password', [OrtuAuthController::class, 'showChangePassword'])
            ->name('ortu.change-password');

        Route::post('/ortu/ubah-password', [OrtuAuthController::class, 'changePassword'])
            ->name('ortu.change-password.process');

        // Bayar Tagihan
        Route::get('/ortu/tagihan', [OrtuTagihanController::class, 'index'])
            ->name('ortu.tagihan.index');

        // Form Upload Bukti Transfer
        Route::get('/ortu/tagihan/{id}/bayar', [OrtuTagihanController::class, 'showBayarForm'])
            ->name('ortu.tagihan.bayar');

        // Submit Pembayaran
        Route::post('/ortu/tagihan/{id}/bayar', [OrtuTagihanController::class, 'submitPembayaran'])
            ->name('ortu.tagihan.submit');

        // Pengajuan Beasiswa
        Route::get('/ortu/beasiswa', [OrtuBeasiswaController::class, 'create'])
            ->name('ortu.beasiswa.create');

        Route::post('/ortu/beasiswa', [OrtuBeasiswaController::class, 'store'])
            ->name('ortu.beasiswa.store');
    });
