@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row justify-content-center mt-5">
		@foreach($skills as $skill)
		<div class="col-md-4">
			<div class="card mb-5" style="width: 18rem;">
			  <img class="card-img-top" src="{{ asset('storage/images/skills/'.$skill->image) }}" alt="Card image cap" height="150">
			  <div class="card-body">
			    <h6 class="card-title"><b>{{ $skill->skill }}</b></h6>
				<p class="card-text">{{ substr($skill->discription,0,80) }}...</p>
			    <a href="{{ route('user.skills.freelancers',$skill->id) }}" class="text-muted text-decoration-none"><i class="fa fa-user" aria-hidden="true"></i>  Freelancer</a>
			    <a href="{{ route('user.skills.projects',$skill->id) }}" class="text-muted float-right text-decoration-none"><i class="fas fa-project-diagram"></i>  Project</a>
			  </div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection