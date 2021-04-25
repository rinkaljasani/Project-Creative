@extends('layouts.user')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
				<div class="col-8 card">
			<center><label class="form-label my-5 text-uppercase font-weight-bold">Upload Competition Sample data </label></center>
			<form action="{{ route('user.competitions.sampledata.store')}}" method="post" enctype="multipart/form-data">	
				@csrf
			  	<div class="form-group">
			  		<label class="form-label">Competition Name : {{ $participant->competition->name }}</label>
				</div>
				<input type="hidden" name="bid_id" value="{{ $participant->id}}">
				{{-- 
				<div class="form-group">
			  		<label class="form-label">Select File type</label>
			  		<select class="form-control" required>
			  			<option>Image</option>
			  			<option>Video</option>
			  			<option>Text Document</option>
			  		</select>
				</div> --}}
				<div class="form-group">
			  		<label class="form-label">Upload Data</label>
			  		<input type="file" class="form-control form-control @error('file') is-invalid @enderror" placeholder="Total days for Completation" name="data" required>
			  		@error('file')
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