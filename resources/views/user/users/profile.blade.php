@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
                
                <div class="card-body">
                    <div class="form-group row">
                        {{-- @dd(asset('storage/images/users/'.auth()->user()->image )) --}}
                        <div class=" col-md-5 text-md-right"><img src="{{ URL::asset('storage/images/users/'.auth()->user()->image ) }}" class="rounded-circle text-md-right" width="150" height="150"></div>
                        <label for="name" class="col-md-7 col-form-label text-md-left mt-3">
                            <h4><b>{{ auth()->user()->name }}</b></h4>
                            <p>{{ auth()->user()->email }}</p>
                            <br>
                        </label>
                    </div>
                    <hr>
                    <ul class="nav nav-tabs justify-content-center mb-3 border-bottom-0">
                        <li class="active"><a data-toggle="tab" href="#myproject" class="btn btn-light mr-4">My Created Project</a></li>
                        <li><a data-toggle="tab" href="#menu1" class="btn btn-light  mr-4">My Competition</a></li>
                        <li><a data-toggle="tab" href="#menu2" class="btn btn-light  mr-4">Participant Competition</a></li>
                        <li><a data-toggle="tab" href="#menu3" class="btn btn-light  mr-4">Assigned Project</a></li>
                    </ul>

                      <div class="tab-content">
                        <div id="myproject" class="tab-pane fade in active">
                          <div class="container mt-5">
                            <div class="row justify-content-center">
                                @foreach(auth()->user()->projects as $project)
                                    <div class="col-4">
                                        <div class="card text-center">
                                          <div class="card-header bg-dark text-white">
                                            <a href="{{ route('user.projects.show',Crypt::encryptString($project->id)) }}" class="text-white text-decoration">{{ $project->name }}</a>
                                          </div>
                                          <div class="card-body">
                                            <h5 class="card-title mb-4">BUDGET : <b>&nbsp;Rs {{ $project->budget }} </b></h5><hr>
                                            <p class="card-text">{{ substr($project->detail,0,75) }} ...</p>
                                            <hr>
                                            <a href="#" class="text-muted">Vendor : {{ $project->user->name}}</a>
                                          </div>
                                          <div class="card-footer text-muted">
                                            {{ $project->created_at->diffForHumans() }}
                                          </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        </div>

                        <div id="menu1" class="tab-pane fade">
                          <div class="container mt-5">
                            <div class="row justify-content-center">
                                @foreach(auth()->user()->projectcompetitions as $competition)
                                    <div class="col-4">
                                        <div class="card text-center">
                                          <div class="card-header bg-dark text-white">
                                            <a href="{{ route('user.competitions.show',Crypt::encryptString($competition->id)) }}" class="text-white text-decoration">{{ $competition->name }}</a>
                                          </div>
                                          <div class="card-body">
                                            <h5 class="card-title mb-4">BUDGET : <b>&nbsp;Rs {{ $competition->project->budget }} </b></h5><hr>
                                            <p class="card-text">Project : {{ $competition->project->name }}</p>
                                            <p class="card-text">Project Detail : {{ substr($competition->project->detail,0,75) }} ...</p>
                                            <hr>
                                            <a href="#" class="text-muted">Vendor : {{ $competition->project->user->name}}</a>
                                          </div>
                                          <div class="card-footer text-muted">
                                            {{ $project->created_at->diffForHumans() }}
                                          </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                          </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <div class="container mt-5">
                                <div class="row justify-content-center">
                                    @if($participants != null)
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                  <th scope="col">#</th>
                                                  <th scope="col">Project Name</th>
                                                  <th scope="col">Competition Name</th>
                                                  <th scope="col">Registration Date</th>
                                                  <th scope="col">Competition Submission last Date</th>
                                                  <th scope="col">Project Budget</th>
                                                  <th scope="col">status</th>
                                                  <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($participants as $participant) 
                                                <tr>
                                                  <th scope="row">{{ $loop->index+1 }}</th>
                                                  <td>{{ $participant->competition->project->name}}</td>
                                                  <td>{{ $participant->competition->name}}</td>
                                                  <td>{{ $participant->created_at}}</td>
                                                  <td>{{ $participant->competition->model_submission_last_date }}</td>
                                                  <td>{{ $participant->competition->project->budget }}</td>
                                                  @if($participant->isAssinged == 0)
                                                    <td>Pending</td>
                                                  @else
                                                    <td>Assigned Project</td>
                                                  @endif
                                                  <td>
                                                      <form action="{{ route('user.participants.destroy', $participant->id) }}" method="POST">
                                                          <input type="hidden" name="_method" value="DELETE">
                                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                          <button type="submit" class="btn btn-danger">Leave Competition</button>
                                                      </form>
                                                  </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                             <div class="container mt-5">
                                <div class="row justify-content-center">
                                    @if($participants != null)
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                  <th>#</th>
                                                  <th>Project Name</th>
                                                  <th>Project Budget</th>
                                                  <th>Project Total Days</th>
                                                  <th>Project Total Hours</th>
                                                  <th>Project Assigned Date</th>
                                                  <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($participants as $participant) 
                                                @if($participant->isAssinged == 1)
                                                <tr>
                                                  <th scope="row">{{ $loop->index+1 }}</th>
                                                  <td>{{ $participant->competition->project->name}}</td>
                                                  <td>{{ $participant->competition->project->budget}}</td>
                                                  <td>{{ $participant->competition->project->total_days}}</td>
                                                  <td>{{ $participant->competition->project->total_hours }}</td>
                                                  <td>{{ $participant->updated_at }}</td>
                                                  <td>
                                                        <button type="submit" class="btn btn-danger">Submit Project</button>
                                                      
                                                  </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
