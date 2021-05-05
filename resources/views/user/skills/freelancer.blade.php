@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row justify-content-center mt-5">
		@foreach($freelancer_skills as $freelancer_skill)
		<div class="text-center">
				<div class="card" style="width: 18rem;">
				  <img src="{{ asset('storage/images/users/'.$freelancer_skill->freelancer->user->image)}}" alt="John" width="100%" height="200"><br>
				  <h1>{{ $freelancer_skill->freelancer->user->name }}</h1>
				  <p class="title">Level : {{ $freelancer_skill->freelancer->level }}</p>
				  Skill : 
				  @foreach($freelancer_skill->freelancer->skills as $fskill)
				  	@foreach($skills as $skill)
				  		@if($skill->id == $fskill->skill_id)
				  			{{ $skill->skill }}
				  		@endif
				  	@endforeach
				  @endforeach
				  <p><a class="btn btn-dark text-decoration-none mt-4 text-light" href="{{ route('user.freelancers.show',Crypt::encryptString($freelancer_skill->freelancer->id)) }}">Show Profile</a></p>
				</div>
			</div>
		@endforeach
	</div>
</div>
@endsection