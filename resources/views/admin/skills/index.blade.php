@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5 shadow-sm">
        	
        	<table class="table">
        		
        	
        			<a href="{{ route('admin.skills.create')}}" class="btn btn-primary float-right">Add New skill</a><br><br>
        	
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Skill Image</th>
			      <th scope="col">Skill Name</th>
			      
			      <th scope="col">Skill Detail</th>
			      <th scope="col" colspan="2" class="text-center">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($skills as $skill)
			  	<tr>
			      <th scope="row">1</th>
			      <td><a href=""><img src="{{ asset('storage/images/skills/'.$skill->image) }}" class="rounded p-1"   alt="no" height="50" width="50" /></td>
			      <td><a href="">{{ $skill->skill }}</td>
			      
			      	<td>{{ $skill->discription }}</td>
			      <td><a href="{{ route('admin.skills.edit',$skill->id)}}" class="btn btn-success"><i class=" fa fa-edit"></a></td>
			      <td>
			      <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST">
	                  <input type="hidden" name="_method" value="DELETE">
	                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                  <button class="btn btn-danger" type="sumit"><i class="fa fa-trash"></i></button>
	              </form>
			      </td>
			      
			    </tr>
			  	@endforeach
			    
			  </tbody>
			</table>
		</div>
	</div>
</div>

@endsection