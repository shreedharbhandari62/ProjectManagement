@extends('layouts/app')
@section('content')


     
      <div class="col-sm-9 col-md-9 col-lg-9 pull-left">

        <!-- Jumbotron -->
        <div class="jumbotron">
          <h1>{{ $company->name }}</h1>
          <p class="lead">{{ $company->description }}</p>
        </div>

        <!-- Example row of columns -->
        <div class="row" style="background-color: white;margin:10px;">
          <a class="pull-right btn btn-default btn-md" href="/projects/create/{{ $company->id }}">Add Project</a>
          @foreach($company->projects as $project)
          <div class="col-lg-4">
            <h2>{{$project->name}}</h2>
            <p class="text-default"> {{$project->description}}</p>
            <p><a class="btn btn-primary" href="/projects/{{ $project->id }}" role="button">View Project »</a></p>
          </div>
          @endforeach
        </div>

      </div>
      <div class="col-md-3 col-lg-3 pull-right">
         
          <div class="sidebar-module">
            <h4>Action</h4>
            <ol class="list-unstyled">
              <li><a href="/companies/{{ $company->id }}/edit">Edit Company</a></li>
              <li><a href="/projects/create/{{ $company->id }}">Add Project</a></li>
              <li><a href="/companies">All Companies</a></li>
              <li><a href="/companies/create">Create new Company</a></li>
              <br/>
              <li><a href="#" 
                onclick=" var result = confirm('Are you sure you want to delete this Company?');
                if (result) {
                  event.preventDefault();
                  document.getElementById('delete-form').submit();
                }
                ">
              Delete Company</a>

              <form method="POST" action="{{route('companies.destroy',[$company->id])}}" style="display :none;" id="delete-form">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="delete">               
              </form>
              </li>
              
            </ol>
          </div>
          <!-- <div class="sidebar-module">
            <h4>Members</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
            </ol>
          </div> -->
        </div>
 

    @endsection