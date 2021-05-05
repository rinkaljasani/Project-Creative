@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		@foreach($project_skills as $project_skill)
		<div class="col-4">
			<div class="card text-center">
			  <div class="card-header bg-dark text-white">
			    <a href="{{ route('user.projects.show',Crypt::encryptString($project_skill->project->id)) }}" class="text-white text-decoration">{{ $project_skill->project->name }}</a>
			  </div>
			  <div class="card-body">
			    <h5 class="card-title mb-4">BUDGET : <b>&nbsp;Rs {{ $project_skill->project->budget }} </b></h5><hr>
			    <p class="card-text">{{ substr($project_skill->project->detail,0,75) }} ...</p>
			    <hr>
			    <a href="#" class="text-muted">Vendor : {{ $project_skill->project->user->name}}</a>
			  </div>
			  <div class="card-footer text-muted">
			    {{ $project_skill->project->created_at->diffForHumans() }}
			  </div>
			</div>
		</div>
		@endforeach
	</div>
</div>	
@endsection