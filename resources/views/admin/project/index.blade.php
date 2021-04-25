@extends('layouts.admin')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 mt-5 shadow-sm">        
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Project Name</th>
            <th scope="col">Project Owner</th>
            <th scope="col">Project Budget</th>
            <th scope="col">Project Running Total Days</th>
            <th scope="col">Project Created Date</th>
            <th scope="col" colspan="2" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($projects as $project)
            <tr>
              <td>{{ $loop->iteration}}</td>
              <td>{{ $project->name }}</td>
              <td>{{ $project->user->name }}</td>
              <td>{{ $project->budget }}</td>
              <td>{{ $project->total_days }}</td>
              <td>{{ $project->created_at }}</td>
              <td><a href="{{ route('admin.projects.show',$project->id)}}" class="btn btn-success"><i class=" fa fa-eye"></a></td>
            </tr>
          @endforeach   
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection