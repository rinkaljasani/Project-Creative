<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }
    return redirect()->route('user.home');
});

Auth::routes(['register' => true]);
// Admin

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'namespace' => 'User',
    'middleware' => ['auth']
], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/user-profile', 'UserController@profile')->name('profile');
    Route::get('/create-competition/{id}', 'CompetitionController@create')->name('competitions.create');
    Route::get('/competitions', 'CompetitionController@index')->name('competitions.index');
    Route::post('/competitions', 'CompetitionController@store')->name('competitions.store');
    Route::delete('/competition/competitions/{competition}','CompetitionController@destroy')->name('competitions.destroy');
    Route::get('/competition/competitions/{competition}','CompetitionController@show')->name('competitions.show');
    Route::get('/competition/sample-data/create/{id}','CompetitionController@sampledata')->name('competitions.sampledata.create');
    Route::post('/competition/sample-data','CompetitionController@sampledataStore')->name('competitions.sampledata.store');
    Route::get('/competition/sample-data/{id}','CompetitionController@sampledataShow')->name('competitions.sampledata.show');
    Route::post('single/competition/data','CompetitionController@competitionData')->name('competitions.sampledata.store');
    Route::resource('users','UserController');
    Route::resource('skills','SkillController');
    Route::resource('projects','ProjectController');
    Route::resource('participants','ParticipantController');
    Route::resource('freelancers','FreelancerController');
    Route::post('/compitition/mydata','UserController@myParticipartData')->name('participartdata');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['admin','auth']
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('users','UserController');
    Route::resource('skills','SkillController');
    Route::resource('projects','ProjectController');
    Route::resource('competitions','CompetitionController');
    
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});
