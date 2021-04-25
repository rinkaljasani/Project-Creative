@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-10">
			<div class="card">
			  <div class="card-header">
			    <h4 class="mt-3"><a href="{{ route('user.projects.show',Crypt::encryptString($project->id)) }}" class="text-muted text-decoration">{{ $project->name }}</a><small class="float-right">{{ $project->created_at->diffForHumans() }}</small></h4>
			  </div>
			  
			  <div class="card-body">
			    <p class="card-text">{{ $project->detail }} ...</p>
			    <p class="card-text">Project Deadline In Hours : {{ $project->total_hours }} </p>
			    <p class="card-text">Project Deadline In Days : {{ $project->total_days }} </p>
			    <p class="card-text">Required Freelancer Skills 
                    @foreach($project->skills as $skill)
                   		{{ $skill->skill->skill }},
                    @endforeach
			    </p>
			    <p>
			    	Language :
                    @foreach($project->languages as $language)
                    	{{ $language->language->name }},
                    @endforeach
			    </p>
			    <p>Vendor : <a href="#" class="text-dark">{{ $project->user->name}}</a></p>
			    <h5 class="card-title mb-4">BUDGET : <b>&nbsp;Rs {{ $project->budget }} </b></h5>
			    
			  </div>
			  	@if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
            	@endif  
			  <div class="card-footer text-muted">
			  	
			  	<a href="{{ route('user.projects.edit', Crypt::encryptString($project->id)) }}" class="btn btn-dark">Edit</a>
			  	<a href="{{ route('user.competitions.create', Crypt::encryptString($project->id)) }}" class="btn btn-dark">Create Competition</a>
			    
			  </div>
			</div>
		</div>
	</div>
</div>	
@endsection