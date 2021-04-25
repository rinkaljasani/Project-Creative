@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row justify-content-center mt-5">
		<div class="col-8">
			 @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif    
			<div class="form-group row">
                <div class=" col-md-4 text-md-right"><img src="{{ asset('storage/images/users/'.Auth::user()->image)}}" class="rounded-circle text-md-right" width="100" height="100"></div>
                    <label for="name" class="col-md-8 col-form-label text-md-left mt-3">
                        User Name : <b>{{ Auth::user()->name }}</b><br><br>
                        Email : <b>{{ Auth::user()->email }}</b>
                    </label>
            </div>
			<form action="{{ route('user.freelancers.store')}}" method="post">
				@csrf
			  <div class="form-group mt-5">
			    <label for="exampleFormControlSelect1">Select Your Level</label>
			    <select class="form-control" id="exampleFormControlSelect1" required="" name="level">
			      <option>Beginner</option>
			      <option>Intermediate</option> 
			      <option>Expert</option>
			    </select>
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlSelect2">Select Your Language (Can Select Multiple)</label>
			    <select multiple class="form-control" id="exampleFormControlSelect2" required="" name="languages[]">
			      @foreach($languages as $language)
			      	<option value="{{ Crypt::encryptString($language->id) }}">{{ $language->name }}</option>
			      @endforeach
			    </select>
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlTextarea1">Skills</label><br>
			    	@foreach($skills as $skill)
                    <input type="checkbox" value="{{ Crypt::encryptString($skill->id) }}" name="skills[]" class="ml-3"> {{ $skill->skill }}
                    @endforeach
			  </div><br>
			  <div class="form-group">
			  	<center><input type="Submit" Value="Submit" class="btn btn-dark m-auto"></center>
			  </div>
			</form>
		</div>
	</div>
</div>
@endsection