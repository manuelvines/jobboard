<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Mail\Notification;
use App\Mail\ReceivedCandidate;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Volt::route('/', 'public.index')
->name('index');

/**Jobs*/
Volt::route('jobs', 'jobs.index-job')
->middleware(['auth'])
->name('jobs.index');

Volt::route('jobs/create', 'jobs.create-job')
->middleware(['auth'])
->name('jobs.create');

Volt::route('jobs/{job}/edit', 'jobs.edit-job')
->middleware(['auth'])
->name('jobs.edit');


Volt::route('candidates/{job}', 'candidate.show-candidates')
->middleware(['auth'])
->name('candidates.show');


/**Job show*/
Volt::route('aplicar/{job}','jobs.show-job')
->name('job.show');


/**Candidates*/
Route::get('mail-candidate', function(){
    //return (new ReceivedCandidate('John Doe'))->render();
    $candidate = App\Models\Candidate::with([
        'job' => function($query){
            $query->select('id', 'title');
        }])->find(17);

    $response = Mail::to('cacvmanu@gmail.com')->send(new ReceivedCandidate($candidate));    

    dump($response);

    //return new ReceivedCandidate($candidate);

});

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
