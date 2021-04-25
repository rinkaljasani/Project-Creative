@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row justify-content-center mt-5">
		@foreach($skills as $skill)
		<div class="col-md-4">
			<div class="card" style="width: 18rem;">
			  <img class="card-img-top" src="{{ asset('storage/images/skills/'.$skill->image) }}" alt="Card image cap" height="150">
			  <div class="card-body">
			    <h6 class="card-title"><b>{{ $skill->skill }}</b></h6>
				<p class="card-text">{{ $skill->discription }}</p>
			    <a href="#" class="text-muted text-decoration-none"><i class="fa fa-user" aria-hidden="true"></i>  Freelancer</a>
			    <a href="#" class="text-muted float-right text-decoration-none"><i class="fas fa-project-diagram"></i>  Project</a>
			  </div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection