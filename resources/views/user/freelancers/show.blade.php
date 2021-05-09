@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
                
                <div class="card-body">
                    <div class="form-group row">
                        <div class=" col-md-5 text-md-right"><img src="{{ asset('storage/images/users/'.$freelancer->user->image)}}" class="rounded-circle text-md-right" width="150" height="150"></div>
                        <label for="name" class="col-md-7 col-form-label text-md-left mt-3">
                            <h4><b>{{ $freelancer->user->name }}</b></h4>
                            Level : {{ $freelancer->level}}<br>
                            Skill :
                            @foreach($freelancer->skills as $skill)
                            	{{ $skill->skill->skill }},
                            @endforeach
                            <br>
                            Language :
                            @foreach($freelancer->languages as $language)
                            	{{ $language->language->name }},
                            @endforeach
                        </label>

                    </div>
                    <hr>
                    <div class="form-group row">
                       <h5 class="text-uppercase m-auto">Project</h5><br>
                       <table class="table col-md-8">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Project Name</th>
                                  <th scope="col">Project Budget</th>
                                </tr>
                              </thead>
                              <tbody>
                               @foreach($projects as $project)
                                    <tr>
                                        <td>1</td>
                                        <td><a href="{{ route('user.projects.show',Crypt::encryptString($project->id)) }}" class="text-dark text-decoration">{{ $project->name }}</a></td>
                                        <td>{{ $project->budget }}</td>
                                    </tr>
                               @endforeach
                               </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
