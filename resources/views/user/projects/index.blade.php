@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		@foreach($projects as $project)
		<div class="col-4">
			<div class="card text-center">
			  <div class="card-header bg-dark text-white">
			    <a href="{{ route('user.projects.show',Crypt::encryptString($project->id)) }}" class="text-white text-decoration">{{ $project->name }}</a>
			  </div>
			  <div class="card-body">
			    <h5 class="card-title mb-4">BUDGET : <b>&nbsp;Rs {{ $project->budget }} </b></h5><hr>
			    <p class="card-text">{{ substr($project->detail,0,75) }} ...</p>
			    <hr>
			    <a href="#" class="text-muted">Vendor : {{ $project->user->name}}</a>
			  </div>
			  <div class="card-footer text-muted">
			    {{ $project->created_at->diffForHumans() }}
			  </div>
			</div>
		</div>
		@endforeach
	</div>
</div>	
@endsection