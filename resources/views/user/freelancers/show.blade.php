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
                       <h5 class="text-uppercase m-auto">Project</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
