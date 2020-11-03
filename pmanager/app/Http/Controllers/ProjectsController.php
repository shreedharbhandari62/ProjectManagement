<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\ProjectUser;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::check()) {
           // dump(Auth::user()->id);
            $projects = Project::where('user_id', Auth::user()->id)->get();

            return view('projects.index',['projects'=>$projects]);
        }
        return view('auth.login');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)
    {
        //
        $companies =  null;
        if (!$company_id) {
            $companies = Company::where('user_id', Auth::user()->id)->get();
            
        }
      
        return view('projects.create',['company_id'=>$company_id, 'companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (Auth::check()) {
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'company_id' => $request->input('company_id'),
                'user_id' => Auth::user()->id

            ]);
            if ($project) {
            return redirect()->route('projects.show',['project'=>$project->id])
            ->with('success','project created successfully');;
            
        }
        }

        
        return back()->withInput()->with('errors','New project couldn`t be created');
    }


    public function adduser(Request $request)
    {
        //add user to project, takes a projects and add user to it

        $project = Project::find($request->input('project_id'));

        

        //finding the user email as from user table that matches input email
        $user = User::where('email', $request->input('email'))->first();//first() is used when single record is needed

        // check is user already exists
        $projectuser = ProjectUser::where('user_id', $user->id)
                                    ->where('project_id', $project->id)
                                    ->first();

        if ($projectuser) {
            return redirect()->route('projects.show',['project'=>$project->id])->with('success', $request->input('email').' is already the member of the project');
        }
            
        
        if ( Auth::user()->id == $project->user_id) {

            if ($user && $project) {
                $project->users()->attach($user->id);  
                return redirect()->route('projects.show',['project'=>$project->id])->with('success', $request->input('email').' is added to the project successfully');
            }
            
        }

        return back()->withInput()->with('errors','User couldn`t be added to the project');
        
        
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //

        //$project = Project::where('id', $project)->first();
        $project = Project::find($project->id);
        $comments = $project->comments;
        return view('projects.show',['project'=>$project, 'comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        $project = Project::find($project->id);
        return view('projects.edit',['project'=>$project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //save

        $projectUpdate = Project::where('id', $project->id)
                                ->update([
                                    'name' => $request->input('name'),
                                    'description' => $request->input('description')
                                ]);

        if ($projectUpdate) {   
            return redirect()->route('projects.show',['project'=>$project->id])->with('success','project updated successfully');
        }
        //redirect to page coming from if not successfull
        return back()->withInput()->with('errors','project couldn`t be updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
        //dd($project);
        $findproject = Project::find($project->id);
        if ($findproject->delete()) {
            return redirect()->route('projects.index')->with('success','project deleted successfully');
        }
        return back()->withInput()->with('errors','project couldn`t be deleted');
    }
}
