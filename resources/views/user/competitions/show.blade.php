@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-10">
			<div class="card">
			  <div class="card-header">
			  
			    <h4 class="mt-3"><a href="{{ route('user.projects.show',Crypt::encryptString($competition->project->id)) }}" class="text-muted text-decoration">{{ $competition->name }}</a><small class="float-right">{{ $competition->created_at->diffForHumans() }}</small></h4>
			  </div>
			  </div>
			<div class="card">
			<center><label class="form-label my-5 text-uppercase font-weight-bold">Project Detail</label></center>
            
			  <div class="card-body">
			    <p class="card-text">{{ $competition->project->detail }} ...</p>
			    <p class="card-text">Project Deadline In Hours : {{ $competition->project->total_hours }} </p>
			    <p class="card-text">Project Deadline In Days : {{ $competition->project->total_days }} </p>
			    <p class="card-text">Required Freelancer Skills : 
                    @foreach($competition->project->skills as $skill)
                   		{{ $skill->skill->skill }},
                    @endforeach
			    </p>
			    <p>
			    	Language :
                    @foreach($competition->project->languages as $language)
                    	{{ $language->language->name }},
                    @endforeach
			    </p>
			    <p>Vendor : <a href="#" class="text-dark">{{ $competition->project->user->name}}</a></p>
			    <p>Project Created : <a href="#" class="text-dark">{{ $competition->created_at->diffForHumans() }}</a></p>
			    <h5 class="card-title mb-4">BUDGET : <b>&nbsp;Rs {{ $competition->project->budget }} </b></h5>
			  </div>
			</div>
			<div class="card">
			<center><label class="form-label my-5 text-uppercase font-weight-bold">Competition Detail</label></center>
            
			  <div class="card-body">
			    <p class="card-text">Competition Name : {{ $competition->name }} ...</p>
			    <p class="card-text">Competition Last Date :<b> {{ $competition->registration_last_date }} </b></p>
			    <p class="card-text">Competition First Model Submission last Date : {{ $competition->model_submission_last_date }} </p>
			    <p>Vendor : <a href="#" class="text-dark">{{ $competition->project->user->name}}</a></p>
			    <p class="card-text">Total Bids : {{ $competition->participants->count() }}</p>
			    <p>Competition Created : <a href="#" class="text-dark">{{ $competition->created_at->diffForHumans() }}</a></p>
			  </div>
			  <div class="card-footer text-muted">
			  	{{-- @dd($status); --}}

			  	@if($competition->user_id != Auth::id())

				  	@if($status == 'bid')
					  	<form action="{{ route('user.participants.destroy', $id) }}" method="POST">
		                  <input type="hidden" name="_method" value="DELETE">
		                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
		                  <button type="submit" class="btn btn-dark">Remove Bid</button>
		                  <a href="{{ route('user.competitions.sampledata.create',Crypt::encryptString($competition->id))}}" class="btn btn-dark">Submit Data</a>
		              	</form>
				  	@else
				  	<form action="{{ route('user.participants.store') }} " method="post">
				  		@csrf
				  		<input type="hidden" name="competition_id" value="{{ Crypt::encryptString($competition->id) }}">
				  		<button type="submit" class="btn btn-dark">Bid</button>	
				  	</form>
				  	@endif
				@else
					<a href="{{ route('user.competitions.get.freelancer.data',$competition->id) }}" class="btn btn-dark">Show Data</a>
				@endif
			  </div>
			</div>
		</div>
	</div>
</div>	
@endsection