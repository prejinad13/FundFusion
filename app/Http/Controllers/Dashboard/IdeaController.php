<?php

namespace App\Http\Controllers\Dashboard;

use Throwable;
use App\Models\Idea;
use App\Models\Sector;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Idea\AddFormRequest;
use App\Http\Requests\Idea\EditFormRequest;

class IdeaController extends BaseController
{

    protected  $base_route = 'dashboard.ideas';
    protected  $view_path  = 'new-dashboard.ideas';
    protected  $panel      = 'Idea';
    protected  $permission = 'idea';

    // For Permission

    public function __construct()
    {
        $this->middleware(['is_investee','kyc_verified'])->only(['index','create','store','show','edit','update','delete','changeStatus']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['data'] = Idea::where('investee_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view(parent::commonData($this->view_path.'.index'),compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['investment_sectors']=Sector::all();
        return view(parent::commonData($this->view_path.'.create'),compact('data'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddFormRequest $request)
    {
        try{
            $request->request->add(['investee_id'=>Auth::user()->id,'slug'=>Str::slug($request->name)]);
            $idea=Idea::create($request->all());
            if ($request->get('investment_sectors')) {
                $idea->sectors()->attach($request->input('investment_sectors'));
            }
        }catch(Throwable $e){
            Session::flash('error', $e->getMessage());
            return redirect()->route($this->base_route.'.index');
        }
       Session::flash('success', Str::singular($this->panel).' Is Successfully Saved');
       return redirect()->route($this->base_route.'.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=[];
        try{
            $data['data'] = Idea::findOrFail($id);
        }catch(Throwable $e){
            Session::flash('error', $e->getMessage());
            return redirect()->route($this->base_route.'.index');
        }
        return view(parent::commonData($this->view_path.'.show'),compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=[];
        $data['investment_sectors']=Sector::all();
        try{
            $data['data'] = Idea::findOrFail($id);
        }catch(Throwable $e){
            Session::flash('error', $e->getMessage());
            return redirect()->route($this->base_route.'.index');
        }
        return view(parent::commonData($this->view_path.'.edit'),compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditFormRequest $request, string $id)
    {
        try{
            $request->request->add(['slug'=>Str::slug($request->name)]);
            $idea=Idea::findOrFail($id);
            $idea->update($request->all());
            if ($request->get('investment_sectors')) {
            $idea->sectors()->sync($request->input('investment_sectors'));
            } else {
                $idea->sectors()->detach();
            }

        }catch(Throwable $e){
            Session::flash('error', $e->getMessage());
            return redirect()->route($this->base_route.'.index');
        }
        Session::flash('success', Str::singular($this->panel).' Is Successfully Updated');
        return redirect()->route($this->base_route.'.index');
    }

    public function changeStatus($id)
    {
        try{
            $idea = Idea::findOrFail($id);
            $newStatus = ($idea->status == 'open') ? 'closed' : 'open';
            $idea->update(['status' => $newStatus]);
        }catch(Throwable $e){
            Session::flash('error', $e->getMessage());
            return redirect()->route($this->base_route.'.index');
        }
        Session::flash('success', Str::singular($this->panel).' Is Successfully Updated');
        return redirect()->route($this->base_route.'.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->back();
        // try{
        //     Idea::findOrFail($id)->delete();
        // }catch(Throwable $e){
        //     Session::flash('error', $e->getMessage());
        //     return redirect()->route($this->base_route.'.index');
        // }
        // Session::flash('error', Str::singular($this->panel).' Has Been Deleted');
        // return redirect()->back();
    }
}
