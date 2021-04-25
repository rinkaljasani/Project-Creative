@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row">
		@foreach($freelancers as $freelancer)
			<div class="text-center">
				<div class="card" style="width: 18rem;">
				  <img src="{{ asset('storage/images/users/'.$freelancer->user->image)}}" alt="John" width="100%" height="200"><br>
				  <h1>{{ $freelancer->user->name }}</h1>
				  <p class="title">Level : {{ $freelancer->level }}</p>
				  Skill : 
				  @foreach($freelancer->skills as $fskill)
				  	@foreach($skills as $skill)
				  		@if($skill->id == $fskill->skill_id)
				  			{{ $skill->skill }}
				  		@endif
				  	@endforeach
				  @endforeach
				  <p><a class="btn btn-dark text-decoration-none mt-4 text-light" href="{{ route('user.freelancers.show',Crypt::encryptString($freelancer->id)) }}">Show Profile</a></p>
				</div>
			</div>
		@endforeach
		
	</div>
</div>
@endsection