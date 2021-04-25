@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row justify-content-center mt-5">
		<div class="col-8 card">
			@if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
            @endif    
			<div class="form-group row card-header">
                <div class=" col-md-4 text-md-right"><img src="{{ asset('storage/images/users/'.Auth::user()->image)}}" class="rounded-circle text-md-right" width="100" height="100"></div>
                    <label for="name" class="col-md-8 col-form-label text-md-left mt-3">
                        Vendor Name : <b>{{ Auth::user()->name }}</b><br>
                        Email : <b>{{ Auth::user()->email }}</b>
                    </label>
            </div>
            <center><label class="form-label my-5 text-uppercase font-weight-bold">Create Project</label></center>
			<form action="{{ route('user.projects.update', Crypt::encryptString($project->id) )}}" method="post">
				@csrf
				@method('put')
			  	<div class="form-group">
			  		<label class="form-label">Project Name</label>
			  		<input type="text" class="form-control form-control @error('name') is-invalid @enderror" placeholder="Enter Project Name" name="name" required="" value="{{ $project->name}}">
			  		 @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
				<div class="form-group">
			    <label>Project</label><br>
				    <textarea class="form-control" name="detail" rows="3">{{ $project->detail }}</textarea>
                    @error('skill')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            	@enderror
			  </div>
				<div class="form-group">
			  		<label class="form-label">Project Budget</label>
			  		<input type="number" class="form-control form-control @error('budget') is-invalid @enderror" placeholder="Enter your Budget" name="budget" required="" value="{{ $project->budget }}">
			  		 @error('budget')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
				<div class="form-group">
			  		<label class="form-label">Deadline In Days</label>
			  		<input type="number" class="form-control form-control @error('total_days') is-invalid @enderror" placeholder="Total days for Completation" name="total_days" required="" value="{{ $project->total_days }}">
			  		@error('total_days')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
				<div class="form-group">
			  		<label class="form-label">Deadline In Hours</label>
			  		<input type="text" class="form-control form-control @error('total_hours') is-invalid @enderror" placeholder="Total days for Completation" name="total_hours" required value="{{ $project->total_hours }}">
			  		@error('total_hours')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

				</div>
			  	<div class="form-group">
			    	<label>Select Freelancer Level</label>
			    	<select class="form-control form-control @error('level') is-invalid @enderror" required="" name="level" value="{{ $project->level }}">
			      		<option>Beginner</option>
			      		<option>Intermediate</option> 
			      		<option>Expert</option>
			    	</select>
			    	@error('level')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
			  </div>
			  <div class="form-group">
			    <label>Language </label><br>
			    	@foreach($languages as $language)
			    	@php $status = "" @endphp
			    	 	@foreach ($project->languages as $projectlanguage)
                            @if($language->id === $projectlanguage->language_id )
                                @php $status = "check" @endphp
                            @endif
                        @endforeach
                    	<label class="checkbox-inline col-md-3">
                            @if($status == 'check')
                                <input type="checkbox" value="{{ Crypt::encryptString($language->id) }}" name="languages[]" checked=""> {{ $language->name }}
                            @else
                                <input type="checkbox" value="{{ Crypt::encryptString($language->id) }}" name="languages[]"> {{ $language->name }}
                            @endif
                        </label>
                    @endforeach
                    @error('language')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            	@enderror
			  </div>
			  <div class="form-group">
			    <label>Skills</label><br>
			    	@foreach($skills as $skill)
			    	@php $status = "" @endphp
			    	 	@foreach ($project->skills as $projectskill)
                            @if($skill->id === $projectskill->skill_id )
                                @php $status = "check" @endphp
                            @endif
                        @endforeach
                    	<label class="checkbox-inline col-md-3">
                            @if($status == 'check')
                                <input type="checkbox" value="{{ Crypt::encryptString($skill->id) }}" name="skills[]" checked=""> {{ $skill->skill }}
                            @else
                                <input type="checkbox" value="{{ Crypt::encryptString($skill->id) }}" name="skills[]"> {{ $skill->skill }}
                            @endif
                        </label>
                    @endforeach
                    @error('skill')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            	@enderror
			  </div>
			  <br>
			  <div class="form-group">
			  	<center><input type="Submit" Value="Submit" class="btn btn-dark m-auto"></center>
			  </div>
			</form>
		</div>
	</div>
</div>
@endsection