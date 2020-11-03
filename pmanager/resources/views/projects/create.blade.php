@extends('layouts/app')
@section('content')


      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="col-sm-9 col-md-9 col-lg-9 pull-left"  style="background-color: white;">
        <h1>Create New Project</h1>
        

        <!-- Example row of columns -->
        <div class="row col-sm-12 col-md-12 col-lg-12">
          
          <form method="POST" action="{{ route('projects.store') }}">

            {{csrf_field()}}
            
             @if($companies == null)
            <input class="form-control" type="hidden" name="company_id" value="{{ $company_id }}" />
            @endif



            <div class="form-group">
              <label for="project-name">Name<span class="required">*</span></label>
              <input placeholder="Enter name" required id="project-name" name="name" spellcheck="false" class="form-control" />
            </div>

            @if($companies != null)
            <div class="from-group">
              <label for="company-content">Select Company</label>

              <select name="company_id" class="form-control">
                
                @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
                
              </select>             
            </div>
             <br/>
            @endif
           
            <div class="form-group">
              <label for="project-content">Description<span class="required">*</span></label>
              <textarea placeholder="Enter description" required id="project-content" name="description" spellcheck="false" class="form-control autosize-target text-left" style="resize: vertical" rows="5"></textarea>
            </div>

            <div class="form-group">
              <input type="submit"  class="btn btn-primary" value="Submit" />
            </div>

          </form>
         
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
              <li><a href="/projects">My projects</a></li>
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