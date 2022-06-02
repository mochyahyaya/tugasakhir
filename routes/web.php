<?php

use App\Http\Livewire\Admin\Breedings;
use App\Http\Livewire\Admin\Grooms;
use App\Http\Livewire\Admin\Hotels;
use App\Http\Livewire\Admin\Users;
use App\Http\Livewire\Admin\Monitorings;
use App\Http\Livewire\Admin\Pets;
use App\Http\Livewire\Admin\Cages;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\ShowMonitorings;
use App\Http\Livewire\Admin\ShowMonitoringBreedings;
use App\Http\Livewire\Admin\BreedingMonitorings;
use App\Http\Livewire\Admin\Galleries;
use App\Http\Livewire\Admin\PetMonitoring;
use App\Http\Livewire\Admin\PetMonitoringBreedings;

use App\Http\Livewire\User\DashboardU;
use App\Http\Livewire\User\UserBoarding;
use App\Http\Livewire\User\UserBreeding;
use App\Http\Livewire\User\UserGrooming;
use App\Http\Livewire\User\UserPet;
use App\Http\Livewire\USer\UserProfile;
use App\Http\Livewire\User\MonitoringPets;
use App\Http\Livewire\USer\MonitoringUser;
use App\Http\Livewire\USer\MonitoringBreedingUser;
use App\Http\Livewire\USer\MonitoringBreedingPets;
use App\Http\Livewire\USer\HistoryActivity;
use App\Http\Livewire\USer\HistoryActivityBoarding;
use App\Http\Livewire\USer\HistoryActivityBreeding;
use App\Http\Livewire\USer\UserBreedingShow;
use App\Http\Livewire\USer\UserBreedingGalery;


use App\Http\Livewire\Veterinarian\DashboardD;
use App\Http\Livewire\Veterinarian\Inpatients;
use App\Http\Livewire\Veterinarian\MedicalRecords;
use App\Http\Livewire\Veterinarian\MedicalrecordUsers;
use App\Http\Livewire\Veterinarian\MedicalrecordDetails;

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



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('redirects', 'App\Http\Livewire\Admin\Home');

    Route::get('/', function () {
        return view('auth.login');
    });

    Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {

        Route::resource('hotels', \App\Http\Controllers\HotelController::class)
        ->only(['create', 'store']);
    
        Route::get('pets', [\App\Http\Controllers\PetController::class, 'index'])
        ->name('pets.index');

        Route::group(['middleware' => ['role:admin']], function() {

        Route::get('admin/dashboard', Dashboard::class)->name('admin/dashboard');
        Route::get('admin/groom', Grooms::class)->name('admin/grooms');
        Route::get('admin/hotel', Hotels::class)->name('admin/hotels');
        Route::get('admin/monitoring/{id}', Monitorings::class)->name('monitorings');
        Route::get('admin/showmonitoring', ShowMonitorings::class)->name('admin/showmonitorings');
        Route::get('admin/petmonitoring/{id}', PetMonitoring::class)->name('admin/petmonitoring');
        Route::get('admin/breed', Breedings::class)->name('admin/breeds');
        Route::get('admin/breedingmonitoring/{id}', BreedingMonitorings::class)->name('admin/breedingmonitorings');
        Route::get('admin/showmonitoringbreeding', ShowMonitoringBreedings::class)->name('admin/showmonitoringbreedings');
        Route::get('admin/petmonitoringbreedings/{id}', PetMonitoringBreedings::class)->name('admin/petmonitoringbreedings');
        Route::get('admin/user', Users::class)->name('admin/users');
        Route::get('admin/pet', Pets::class)->name('admin/pets');
        Route::get('admin/cage', Cages::class)->name('admin/cages');
        Route::get('admin/gallery/{id}', Galleries::class)->name('admin/gallery');
        Route::get('user/profil', UserProfile::class)->name('user/profil'); 
        });

        Route::group(['middleware' => ['role:veterinarian']], function() {
        Route::get('veterinarian/dashboard', DashboardD::class)->name('veterinarian/dashboard');
        Route::get('veterinarian/inpatients', Inpatients::class)->name('veterinarian/inpatients');
        Route::get('veterinarian/medical-records', MedicalRecords::class)->name('veterinarian/medicalRecords');
        Route::get('veterinarian/medicalrecordUser/{id}', MedicalrecordUsers::class)->name('veterinarian/medicalusers');
        Route::get('veterinarian/medicalrecordDetail/{id}', MedicalRecordDetails::class)->name('veterinarian/medicaldetails');
        Route::get('user/profil', UserProfile::class)->name('user/profil'); 
        });

        Route::group(['middleware' => ['role:user']], function() {
        Route::get('user/dashboard', DashboardU::class)->name('user/dashboard');
        Route::get('user/grooming', UserGrooming::class)->name('user/groomings');
        Route::get('user/hotel', UserBoarding::class)->name('user/hotels');
        Route::get('user/breed', UserBreeding::class)->name('user/breedings');
        Route::get('user/profil', UserProfile::class)->name('user/profil');     
        Route::get('user/pet', UserPet::class)->name('user/pet');   
        Route::get('user/historyactivity', HistoryActivity::class)->name('user/historyactivity');   
        Route::get('user/historyactivityboardings', HistoryActivityBoarding::class)->name('user/historyactivityhotels');   
        Route::get('user/historyactivitybreedings', HistoryActivityBreeding::class)->name('user/historyactivitybreeds');      
        Route::get('user/userbreedingshow', UserBreedingShow::class)->name('user/userbreedingshow');   
        Route::get('user/userbreedinggalery/{id}', UserBreedingGalery::class)->name('user/userbreedinggalery');   
        Route::get('user/monitoringuser', MonitoringUser::class)->name('user/monitoringuser');   
        Route::get('user/monitoringpets/{id}', MonitoringPets::class)->name('user/monitoringpets');   
        Route::get('user/monitoringbreedinguser', MonitoringBreedingUser::class)->name('user/monitoringbreedinguser');   
        Route::get('user/monitoringbreedingpets/{id}', Monitoringbreedingpets::class)->name('user/monitoringbreedingpets');   
        });

});

