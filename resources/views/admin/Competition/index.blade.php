@extends('layouts.admin')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mt-5 shadow-sm">        
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Project</th>
            <th scope="col">Competition Name</th>
            <th scope="col">Competition Owner</th>
            <th scope="col">Competition Registeration Date</th>
            <th scope="col">Competition Submission date</th>
            <th scope="col">Created At</th>
            <th scope="col" colspan="2" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($competitions as $competition)
            <tr>
              <td>{{ $loop->iteration}}</td>
              <td><a href="{{ route('admin.projects.show',$competition->project->id)}}">{{ $competition->project->name}}</a></td>
              <td>{{ $competition->name }}</td>
              <td>{{ $competition->project->user->name }}</td>
              <td>{{ $competition->registration_last_date }}</td>
              <td>{{ $competition->model_submission_last_date }}</td>
              <td>{{ $competition->created_at }}</td>
              <td><a href="{{ route('admin.competitions.show',$competition->id)}}" class="btn btn-success"><i class=" fa fa-eye"></a></td>
            </tr>
          @endforeach   
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection