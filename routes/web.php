<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('dashboard')->group(function () {
    Route::get('/', 'DashboardController@dashboard')
        ->name('dashboard');


    // role
    Route::get('role', 'RoleController@index')
        ->name('role');
    Route::get('tambah.role', 'RoleController@tambah')
        ->name('tambah.role');
    Route::post('simpan.role', 'RoleController@simpan')
        ->name('simpan.role');
    Route::get('edit-role/{id}', 'RoleController@edit')
        ->name('role.edit');
    Route::put('update-role/{id}', 'RoleController@update')
        ->name('role.update');
    Route::get('hapus-role/{id}', 'RoleController@hapus')
        ->name('role.hapus');


    // users
    Route::get('users', 'UserController@index')
        ->name('users');
    Route::get('tambah-users', 'UserController@tambah')
        ->name('tambah.users');
    Route::post('simpan-users', 'UserController@simpan')
        ->name('simpan.users');
    Route::get('listrole-user', 'UserController@listrole')
        ->name('listrole.user');
    Route::get('edit-user/{id}', 'UserController@edit')
        ->name('edit.user');
    Route::put('updat-user/{id}', 'UserController@update')
        ->name('update.user');
    Route::get('role-user/{id}', 'UserController@roleByUser')
        ->name('roleByUser');
    Route::get('hapus-user/{id}', 'UserController@hapus')
        ->name('hapus.user');

    // mapel
    Route::get('mapel', 'MataPelajaranController@index')
        ->name('mapel');
    Route::get('tambah-mapel', 'MataPelajaranController@tambah')
        ->name('tambah.mapel');
    Route::post('simpan-mapel', 'MataPelajaranController@simpan')
        ->name('simpan.mapel');
    Route::get('edit-mapel/{id}', 'MataPelajaranController@ubah')
        ->name('edit.mapel');
    Route::put('update-mapel/{id}', 'MataPelajaranController@update')
        ->name('update.mapel');
    Route::get('hapus-mapel/{id}', 'MataPelajaranController@hapus')
        ->name('hapus.mapel');


    // guru
    Route::get('guru', 'GuruController@index')
        ->name('guru');
    Route::get('tambah-guru', 'GuruController@tambah')
        ->name('tambah.guru');
    Route::post('simpan-guru', 'GuruController@simpan')
        ->name('guru.simpan');
    Route::get('edit-guru/{id}', 'GuruController@ubah')
        ->name('edit.guru');
    Route::put('update-guru/{id}', 'GuruController@update')
        ->name('update.guru');
    Route::get('hapus-guru/{id}', 'GuruController@hapus')
        ->name('hapus.guru');
    Route::get('list-user-guru', 'GuruController@listuser')
        ->name('list-user-guru');
    Route::get('list-user-guru/{id}', 'GuruController@listUserGuru')
        ->name('list-user-guru-byid');


    // kelas
    Route::get('kelas', 'KelasController@index')
        ->name('kelas');
    Route::get('tambah-kelas', 'KelasController@tambah')
        ->name('tambah.kelas');
    Route::post('simpan-kelas', 'KelasController@simpan')
        ->name('simpan-kelas');
    Route::get('listguru', 'KelasController@listguru')
        ->name('listguru.kelas');
    Route::get('hapus-kelas/{id}', 'KelasController@hapus')
        ->name('hapus.kelas');
    Route::get('input-jadwal-siswa/{id}', 'KelasController@input_jadwal_siswa')
        ->name('input.jadwal.siswa');
    Route::get('list-siswa/kelas/{id}', 'KelasController@list_siswa')
        ->name('list-siswa.kelasById');
    Route::post('simpan-jadwal-siswa', 'KelasController@simpan_jadwal_siswa')
        ->name('simpan-jadwal-siswa');
    Route::get('kelas/jadwal-siswa/{id}', 'KelasController@lihat_jadwal_siswa')
        ->name('lihat-jadwal-siswa');
    Route::post('absensi', 'KelasController@absensi')
        ->name('absensi');


    // siswa
    Route::get('siswa', 'SiswaController@index')
        ->name('siswa');
    Route::get('tambah-siswa', 'SiswaController@tambah')
        ->name('tambah.siswa');
    Route::post('simpan-siswa', 'SiswaController@simpan')
        ->name('simpan.siswa');
    Route::get('list-user', 'SiswaController@listuser')
        ->name('list-user');
    Route::get('edit-siswa/{id}', 'SiswaController@edit')
        ->name('edit-siswa');
    Route::put('update-siswa/{id}', 'SiswaController@update')
        ->name('update.siswa');
    Route::get('hapus-siswa/{id}', 'SiswaController@hapus')
        ->name('hapus.siswa');
    Route::get('list-user-siswa/{id}', 'SiswaController@listuserSiswa')
        ->name('list-user.siswa');
    Route::get('tambah-kelas-siswa/{id}', 'SiswaController@tambah_kelas_siswa')
        ->name('tambah-kelas-siswa');
    Route::get('list-kelas-siswa', 'SiswaController@listkelas')
        ->name('list-kelas-siswa');
    Route::post('simpan-kelas-siswa', 'SiswaController@simpan_kelas_siswa')
        ->name('simpan-kelas-siswa');



    // list-pelajaran
    Route::get('list-pelajaran', 'ListPelajaranController@index')
        ->name('list-pelajaran');
    Route::get('tambah-list-pelajaran', 'ListPelajaranController@tambah')
        ->name('tambah-list-pelajaran');
    Route::post('simpan-list-pelajaran', 'ListPelajaranController@simpan')
        ->name('simpan-list-pelajaran');
    Route::get('edit-list-pelajaran/{id}', 'ListPelajaranController@edit')
        ->name('edit.list-pelajaran');
    Route::put('ubah-list-pelajaran/{id}', 'ListPelajaranController@ubah')
        ->name('ubah.list-pelajaran');
    Route::get('hapus-list-pelajaran/{id}', 'ListPelajaranController@hapus')
        ->name('hapus-list-pelajaran');
    Route::get('mata-pelajaran/list-pelajaran', 'ListPelajaranController@mata_pelajaran')
        ->name('mata-pelajaran.list-pelajaran');
    Route::get('pengajaran/list-pelajaran', 'ListPelajaranController@pengajar')
        ->name('pengajar-list-pelajaran');


    Route::get('jadwal-siswa', 'JadwalSiswaController@index')
        ->name('jadwal-siswa');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
