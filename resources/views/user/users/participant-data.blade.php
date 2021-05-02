@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row">
		@foreach($competitions as $competition)
		<div class="col-4">
			<a href="{{ route('user.competitions.singledata.show',$competition->bid_id) }}">
			<figure class="figure">
			  <img src="{{ asset('storage/images/data/'.$competition->data) }}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
			  <figcaption class="figure-caption">Freelancer : {{ $competition->freelancer->user->name }}</figcaption>
			</figure>
			</a>
		</div>
		@endforeach
	</div>
</div>
@endsection