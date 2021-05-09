@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row justify-content-center mt-5">
		<div class="col-8 card">
			<div class="form-group row card-header">
                <div class=" col-md-4 text-md-right"><img src="{{ asset('storage/images/users/'.Auth::user()->image)}}" class="rounded-circle text-md-right" width="100" height="100"></div>
                    <label for="name" class="col-md-8 col-form-label text-md-left mt-3">
                        Vendor Name : <b>{{ Auth::user()->name }}</b><br>
                        Email : <b>{{ Auth::user()->email }}</b>
                    </label>
            </div>

			@if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif  
        </div>  
        <div class="col-8 card">
            <center><label class="form-label my-5 text-uppercase font-weight-bold">Project Detail</label></center>
			<div class="form-group">
		  		<label class="form-label">Project Name : {{ $project->name }}</label><br>
		  		<label class="form-label">Project Level : {{ $project->level }}</label><br>
		  		<label class="form-label">Project Budget : {{ $project->budget }}</label><br>
		  		<label class="form-label">Project Create time : {{ $project->created_at->diffForHumans() }}</label>
			</div>
		</div>
		<div class="col-8 card">
            <center><label class="form-label my-5 text-uppercase font-weight-bold">Competition Detail</label></center>
            
            @foreach($project->competitions as $competition)
			<div class="card my-2">
			  <div class="card-header">
			    <a href="{{ route('user.competitions.show',Crypt::encryptString($competition->id ))}}" class="text-dark">{{ $competition->name}}</a>
			  </div>
			  <div class="card-body">
			    <p class="card-text">Registration Last Date : {{ $competition->registration_last_date}}</p>
			    <p class="card-text">Model Submission Last Date : {{ $competition->model_submission_last_date }}</p>
			    
			    <form action="{{ route('user.competitions.destroy', $competition->id) }}" method="POST">
	                  <input type="hidden" name="_method" value="DELETE">
	                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                  <a class="btn btn-success text-white" href=""><i class="fa fa-edit"></i> Edit</a>
	                  <button class="btn btn-danger" type="sumit"><i class="fa fa-trash"></i> Trash</button>
	            </form>
			    
			  </div>
			</div>
			@endforeach
			
		</div>
		<div class="col-8 card">
			<center><label class="form-label my-5 text-uppercase font-weight-bold">Create Competition</label></center>
			<form action="{{ route('user.competitions.store')}}" method="post">	
				@csrf
				<input type="hidden" name="project_id" value="{{ Crypt::encryptString($project->id) }}">
				
			  	<div class="form-group">
			  		<label class="form-label">Competition Name</label>
			  		<input type="text" class="form-control form-control @error('name') is-invalid @enderror" placeholder="Enter Competition Name" name="name" required="">
			  		 @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
				<div class="form-group">
			  		<label class="form-label">Registration last Date</label>
			  		<input type="date" class="form-control form-control @error('registration_last_date') is-invalid @enderror" placeholder="Registration Last Date" name="registration_last_date" required="">
			  		@error('registration_last_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
				<div class="form-group">
			  		<label class="form-label">Model Submission Last Date</label>
			  		<input type="date" class="form-control form-control @error('model_submission_last_date') is-invalid @enderror" placeholder="Total days for Completation" name="model_submission_last_date" required>
			  		@error('model_submission_last_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

				</div>
				<div class="form-group">
			  		<label class="form-label">Data You Prefererd</label>
			  		<select class="form-control" name="data_type">
			  			<option value="image">Image</option>
			  			<option value="docs">Document</option>
			  			<option value="video">Video</option>
			  		</select>
			  		@error('data_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

				</div>
			  <div class="form-group">
			  	<center><input type="Submit" Value="Submit" class="btn btn-dark m-auto"></center>
			  </div>
			</form>
		</div>
	</div>
</div>
@endsection