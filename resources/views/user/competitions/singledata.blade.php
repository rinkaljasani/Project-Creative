@extends('layouts.user')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-10">
			<div class="card">
			  <div class="card-header">
						  
			    <h4 class="mt-3"><a href="" class="text-muted text-decoration"></a><small class="float-right"></small></h4>
			  </div>
			  </div>
			<div class="card">
			<center><label class="form-label my-5 text-uppercase font-weight-bold">Bid Detail</label></center>
				<div class="card-body ">
					 <div class="row">
            			<div class="col-6">
						    <p class="card-text"></p>
						    <p class="card-text">Project Name : {{ $bid_data->bid->competition->project->name }}</p>
						    <p class="card-text">Competition Name : {{ $bid_data->bid->competition->name }}</p>
						    <p class="card-text">Freelancer Name : {{ $bid_data->freelancer->user->name }}</p>
						    <p class="card-text">Competition Status:

						    	@if($bid_data->isApproved == 0) 
						    		<b>Not Approved</b>
						    		<br><br>
						    		@if(auth()->id() == $bid_data->bid->competition->user_id) 
						    		<form action="{{ route('user.commpetiton.data.approved')}}" method="post">
						    			@csrf
						    			<input type="hidden" name="bid_id" value="{{ $bid_data->id}}">
						    			<button type="submit" class="btn btn-dark">Approved</button>	
						    		</form>	
						    		@endif
						    	@else
						    		<b>Approved</b>
						    		@if(Auth::id() == $bid_data->bid->competition->user_id) 
						    		@if($bid_data->bid->isAssinged == 0)
						    		<form action="{{ route('user.competition.project.assigned')}}" method="post">
						    			@csrf
						    			<input type="hidden" name="bid_id" value="{{ $bid_data->bid->id}}">
						    			<button type="submit" class="btn btn-dark">Assigned Project</button>	
						    		</form>
						    		@endif
						    		@else
						    		<p><p class="card-text">Competition Status: <b>Project Assigned</b></p>
						    		@endif
						    	@endif
						    </p>

						</div>
						<div class="col-6">
							<p>
						    	<img src="{{ asset('storage/images/data/'.$bid_data->data) }}" height="70%" width="100%">
						    </p>
						</div>
				 	</div>
				</div>
			</div>
			
		</div>
	</div>
</div>	
@endsection