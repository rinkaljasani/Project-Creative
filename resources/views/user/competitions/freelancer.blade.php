@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row">

		@foreach($competition_freelancers as $competition_freelancer)
		<div class="col-4">
			<div class="text-center">
				<div class="card" style="width: 18rem;">
				  <img src="{{ asset('storage/images/users/'.$competition_freelancer->freelancer->user->image)}}" alt="John" width="100%" height="200"><br>
				  <a href="{{ route('user.freelancers.show',Crypt::encryptString($competition_freelancer->freelancer->id)) }} "><h3 class="text-dark">{{ $competition_freelancer->freelancer->user->name }}</h3></a></h1>
				  <p class="title">Level : {{ $competition_freelancer->freelancer->level }}</p>
				  Skill : 
				  @foreach($competition_freelancer->freelancer->skills as $fskill)
				  	@foreach($skills as $skill)
				  		@if($skill->id == $fskill->skill_id)
				  			{{ $skill->skill }}
				  		@endif
				  	@endforeach
				  @endforeach
				  <p><a class="btn btn-dark text-decoration-none mt-4 text-light" href="{{ route('user.competitions.get.freelancer.data',$competition_freelancer->id) }}">Show Data</a></p>
				</div>
			</div>
		</div>
		@endforeach
		
	</div>
</div>
@endsection