@extends('layouts/app')
@section('content')


      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="col-sm-9 col-md-9 col-lg-9 pull-left">

        <!-- Jumbotron -->
        <div class="well well-lg">
          <h1>{{ $project->name }}</h1>
          <p class="lead">{{ $project->description }}</p>
          <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p> -->
        </div>

        <!-- Example row of columns -->
        <div class="row" style="background-color: white;margin:10px;">
          <a class="pull-right btn btn-default btn-md" href="/projects/create">Add Project</a>
          <br/>
          
          @include('partials.comments')

          <div class="row container-fluid">
          <form method="POST" action="{{ route('comments.store') }}">

            {{csrf_field()}}
            
            <input type="hidden" name="commentable_type" value="App\Project">
            <input type="hidden" name="commentable_id" value="{{ $project->id }}">


            <div class="form-group">
              <label for="comment-content">Comment<span class="required">*</span></label>
              <textarea placeholder="Enter comment" required id="comment-content" name="body" spellcheck="false" class="form-control autosize-target text-left" style="resize: vertical" rows="3"></textarea>
            </div>

            <div class="form-group">
              <label for="comment-content">Proof of work done(Url/Photos)</label>
              <textarea placeholder="Enter url or screenshots" required id="comment-content" name="url" spellcheck="false" class="form-control autosize-target text-left" style="resize: vertical" rows="2"></textarea>
            </div>

            

            <div class="form-group">
              <input type="submit"  class="btn btn-primary" value="Add Comment" />
            </div>

          </form>
          </div>
  
        </div>

      </div>
      <div class="col-md-3 col-lg-3 pull-right">
          <!-- <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div> -->
          <div class="sidebar-module">
            <h4>Action</h4>
            <ol class="list-unstyled">
              <li><a href="/projects/{{ $project->id }}/edit"><i class="fas fa-edit"></i> Edit project</a></li>
              <li><a href="/projects"><i class="fas fa-briefcase"></i> My projects</a></li>
              <li><a href="/projects/create"><i class="fas fa-plus-circle"></i> Create new project</a></li>
              <br/>
              @if($project->user_id == Auth::user()->id)
              <li><a href="#" 
                onclick=" var result = confirm('Are you sure you want to delete this project?');
                if (result) {
                  event.preventDefault();
                  document.getElementById('delete-form').submit();
                }
                "><i class="fas fa-ban"></i>
              Delete project</a>

              <form method="POST" action="{{route('projects.destroy',[$project->id])}}" style="display :none;" id="delete-form">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="delete">               
              </form>

              </li>
              @endif
              
            </ol>
            <hr/>
            <h4>Add Member</h4>
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">

              <form method="POST" action="{{ route('projects.adduser') }}" id="add-user">
                {{csrf_field()}}
                              
              

                <div class="input-group">

                  <input type="hidden" name="project_id" value="{{ $project->id }}" class="form-control"> 

                  <input type="text" name="email" placeholder="Email" class="form-control"/>

                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Add!</button>                    
                  </span>

                </div>

              </form>
                
              </div>              
            </div>

            <br/>
            <h4>Team Member</h4>
            <ol class="list-unstyled">
              @foreach($project->users as $user)
                <li><a href="">{{ $user->email }}</a></li>
              @endforeach
              
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