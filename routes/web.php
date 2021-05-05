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
    Route::delete('/competition/competitions/{competition}','CompetitionController@destroy')->name('competitions.destroy');// delete competition 
    Route::get('/competition/competitions/{competition}','CompetitionController@show')->name('competitions.show'); //show single competition 
    Route::get('/competition/sample-data/create/{id}','CompetitionController@sampledata')->name('competitions.sampledata.create'); // submit sample compertition data form
    Route::post('/competition/sample-data','CompetitionController@sampledataStore')->name('competitions.sampledata.store'); // store competititon data
    Route::get('/competition/sample-data/{id}','CompetitionController@sampledataShow')->name('competitions.sampledata.show'); // vendor show the competition data
    Route::get('competition/data/get/{competition_id}','CompetitionController@getAllCompetitionFreelancer')->name('compatitions.get.freelancer');
    Route::get('competition/get/freelancerdata/{competition_freelancer_id}','CompetitionController@getSingleFreelancerData')->name('competitions.get.freelancer.data');
    
    Route::get('competition/singledata/show/{id}','CompetitionController@singleDataShow')->name('competitions.singledata.show'); 
    // vendor show the competition data for perticuler bid
    Route::post('competition/singledata/approved','CompetitionController@dataApproved')->name('commpetiton.data.approved'); // freelancer compatition data appoved by vender
    Route::post('project/assigned','CompetitionController@projectAssigned')->name('competition.project.assigned');
    Route::resource('users','UserController');

    Route::resource('skills','SkillController');
    Route::get('skills/freelancers/{id}','SkillController@skillFreelancer')->name('skills.freelancers');
    Route::get('skills/projects/{id}','SkillController@skillProject')->name('skills.projects');

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
