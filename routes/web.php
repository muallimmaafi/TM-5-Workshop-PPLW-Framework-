<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/kategori', function () {
        $data = Kategori::all();
        return view('kategori.index', compact('data'));
    })->name('kategori');

    Route::get('/kategori/create', function () {
        return view('kategori.create');
    })->name('kategori.create');

    Route::post('/kategori', function (\Illuminate\Http\Request $request) {

        \App\Models\Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori');
    })->name('kategori.store');

    Route::get('/kategori/{id}/edit', function ($id) {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    })->name('kategori.edit');

    Route::put('/kategori/{id}', function (\Illuminate\Http\Request $request, $id) {
        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori');
    })->name('kategori.update');

    Route::delete('/kategori/{id}', function ($id) {
        Kategori::destroy($id);
        return redirect()->route('kategori');
    })->name('kategori.destroy');

    Route::get('/buku', function () {
        $data = Buku::with('kategori')->get();
        return view('buku.index', compact('data'));
    })->name('buku');

    Route::get('/buku/create', function () {
        $kategori = \App\Models\Kategori::all();
        return view('buku.create', compact('kategori'));
    })->name('buku.create');

    Route::post('/buku', function (\Illuminate\Http\Request $request) {

        \App\Models\Buku::create([
            'kode' => $request->kode,
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect()->route('buku');
    })->name('buku.store');

    Route::get('/buku/{id}/edit', function ($id) {
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();
        return view('buku.edit', compact('buku', 'kategori'));
    })->name('buku.edit');

    Route::put('/buku/{id}', function (\Illuminate\Http\Request $request, $id) {

        $buku = Buku::findOrFail($id);

        $buku->update([
            'kode' => $request->kode,
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect()->route('buku');
    })->name('buku.update');

    Route::delete('/buku/{id}', function ($id) {
        Buku::destroy($id);
        return redirect()->route('buku');
    })->name('buku.destroy');

    Route::get('/generate-sertifikat', [PdfController::class, 'sertifikat'])->name('pdf.sertifikat');
    Route::get('/generate-undangan', [PdfController::class, 'undangan'])->name('pdf.undangan');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/data', [BarangController::class, 'data'])->name('barang.data');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');

    Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
    Route::post('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');

    Route::delete('/barang/delete/{id}', [BarangController::class, 'destroy'])->name('barang.delete');
    Route::post('/barang/cetak', [BarangController::class, 'cetak'])->name('barang.cetak');

    Route::get('/table/index', function () {
        return view('table.index');
    })->name('table.index');

    Route::get('/datatables/index', function () {
        return view('datatables.index');
    })->name('datatables.index');

    Route::get('/select-kota', function () {
        return view('select-kota');
    })->name('select-kota');

    Route::get('/wilayah-ajax', [WilayahController::class, 'ajaxPage'])->name('wilayah-ajax');

    Route::get('/wilayah-axios', [WilayahController::class, 'axiosPage'])->name('wilayah-axios');

    Route::get('/get-kota/{province_id}', [WilayahController::class, 'getKota']);
    Route::get('/get-kecamatan/{city_id}', [WilayahController::class, 'getKecamatan']);
    Route::get('/get-kelurahan/{district_id}', [WilayahController::class, 'getKelurahan']);

    Route::get(
        '/transaksi/ajax',
        [TransaksiController::class, 'ajaxPage']
    )->name('transaksi-ajax');

    Route::get(
        '/transaksi/axios',
        [TransaksiController::class, 'axiosPage']
    )->name('transaksi-axios');

    Route::get(
        '/get-barang/{kode}',
        [TransaksiController::class, 'getBarang']
    );

    Route::post(
        '/simpan-transaksi',
        [TransaksiController::class, 'simpan']
    );
});

require __DIR__ . '/auth.php';

Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    // cek apakah user sudah ada
    $user = User::where('id_google', $googleUser->id)->first();

    if (!$user) {
        // jika user belum ada, buat user baru
        $user = User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'id_google' => $googleUser->id,
            'password' => bcrypt(Str::random(16)), // random password karena login pakai Google
        ]);
    }

    // Generate OTP 6 digit
    $otp = rand(100000, 999999);
    $user->otp = $otp;
    $user->save();

    // Kirim OTP ke email
    Mail::raw("Kode OTP anda: $otp", function ($message) use ($user) {
        $message->to($user->email)
            ->subject("Kode OTP Login");
    });

    // simpan user id di session sementara
    session(['otp_user_id' => $user->id]);

    return redirect('/verify-otp');
});

Route::get('/verify-otp', function () {
    return view('auth.verify-otp');
});

Route::post('/verify-otp', function (Illuminate\Http\Request $request) {
    // dd($request->all());
    $request->validate([
        'otp' => 'required|digits:6',
    ]);

    $user = User::find(session('otp_user_id'));

    if ($user && $user->otp === $request->otp) {
        // OTP valid, login user
        Auth::login($user);
        $user->otp = null; // hapus OTP setelah berhasil
        $user->save();
        session()->forget('otp_user_id');

        return redirect('/dashboard');
    }

    return back()->withErrors(['otp' => 'Kode OTP salah']);
});
