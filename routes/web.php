<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


use App\Http\Controllers\Admin\BoatController;
use App\Http\Controllers\Admin\SlotController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\MailerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Guests\PageController as GuestsPageController;


Route::get('/', function () {
    return view('guests/home');
});

Route::get('/delete_succes', function () {
    return view('guests/documentazione');
});


Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {

        Route::get('/',           [AdminPageController::class, 'admin'])->name('dashboard'); //calendar
        Route::get('/settings',            [SettingController::class, 'index'])->name('settings');



        Route::get('/contract/index',           [ContractController::class, 'contract'])->name('contract.index');
        Route::get('/contract/edit',            [ContractController::class, 'edit'])->name('contract.edit');
        Route::post('/contract/update',         [ContractController::class, 'update'])->name('contract.update');

        Route::get('/mailer/index',         [MailerController::class, 'mailer'])->name('mailer.index');
        Route::get('/mailer/send_mail',     [MailerController::class, 'send_mail'])->name('mailer.send_mail');
        
        Route::post('/mailer/send_m',       [MailerController::class, 'send_m'])->name('mailer.send_m');
        Route::post('/mailer/extra_list',   [MailerController::class, 'extra_list'])->name('mailer.extra_list');
        
        Route::get('/mailer/create_model',  [MailerController::class, 'create_model'])->name('mailer.create_model');
        Route::post('/mailer/create_m',     [MailerController::class, 'create_m'])->name('mailer.create_m');

        Route::get('/mailer/edit_model/{id}', [MailerController::class, 'edit_model'])->name('mailer.edit_model');

        Route::post('/mailer/update_model',   [MailerController::class, 'update_model'])->name('mailer.update_model');
        Route::delete('/models/{id}',         [MailerController::class, 'delete'])->name('models.delete');



        
        Route::post('settings/updateAll',     [SettingController::class, 'updateAll'])->name('settings.updateAll');

        Route::post('reservations/cancel',    [ReservationController::class, 'cancel'])->name('reservations.cancel');
        Route::post('reservations/update_status',    [ReservationController::class, 'update_status'])->name('reservations.update_status');

        Route::post('clients/changeStatus',    [ClientController::class, 'changeStatus'])->name('clients.changeStatus');

        Route::resource('reservations',  ReservationController::class);
        Route::resource('boats',  BoatController::class);
        Route::resource('clients',  ClientController::class);
        Route::resource('slots',  SlotController::class);

    });

Route::middleware('auth')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


require __DIR__ . '/auth.php';



