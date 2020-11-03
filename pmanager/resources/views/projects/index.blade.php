@extends('layouts/app')
@section('content')

<div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3" >
	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3>
	    Projects   
		<a class="pull-right btn btn-primary" href="/projects/create">Create new Project</a>
		</h3>
	  </div>
	  <div class="panel-body">
		  <ul class="list-group list-group-flush">
		  	@foreach($projects as $project)
		    <li class="list-group-item"><a href="/projects/{{ $project->id }}">{{ $project->name }}</a></li>
		    @endforeach
		  </ul>
	  </div>
	</div>
</div>

@endsection