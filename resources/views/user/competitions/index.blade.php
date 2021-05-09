@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Competition Name</th>
		      <th scope="col">Project Budget</th>
		      <th scope="col">Registration Last Date</th>
		      <th scope="col">Skill</th>
		      <th scope="col">Total Bids</th>
		      <th scope="col">Upload Time</th>
		      <th scope="col"></th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach($competitions as $competition)
			@if($competition->project->isAssinged != 1)
		      	<tr>
		      		<td></td>
		      	<td><a href="{{ route('user.projects.show',Crypt::encryptString($competition->project->id)) }}" class="text-dark text-decoration-none">{{ $competition->name }}</a></td>
		      	<td><b>&nbsp;Rs {{ $competition->project->budget }} </b></td>
		      	<td>{{ $competition->registration_last_date}}</td>
		      	<td>
		      		@foreach($competition->project->skills as $skill)
			    		{{ $skill->skill->skill }},
			    	@endforeach
		      	</td>
		      	<td>{{ $competition->participants->count() }}</td>
		      	<td>{{ $competition->created_at->diffForHumans() }}</td>
		      	<td><a href="{{ route('user.competitions.show',Crypt::encryptString($competition->id ))}}" class="btn btn-dark">Show More Detail</a></td>
		      </tr>
		    @endif
			@endforeach
		  </tbody>
		</table>
		
	</div>
</div>	
@endsection