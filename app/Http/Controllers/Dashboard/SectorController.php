<?php

namespace App\Http\Controllers\Dashboard;

use Throwable;
use App\Models\Sector;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Sector\AddFormRequest;
use App\Http\Requests\Sector\EditFormRequest;

class SectorController extends BaseController
{

    protected  $base_route = 'dashboard.sectors';
    protected  $view_path  = 'new-dashboard.sectors';
    protected  $panel      = 'Sector';
    protected  $permission = 'sector';

    // For Permission

    // public function __construct()
    // {
    //     $this->middleware('can:view-'.$this->permission)->only('index');
    //     $this->middleware('can:create-'.$this->permission)->only(['create','store']);
    //     $this->middleware('can:update-'.$this->permission)->only(['edit','update']);
    //     $this->middleware('can:delete-'.$this->permission)->only(['destroy']);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['data'] = Sector::orderBy('created_at','desc')->get();
        return view(parent::commonData($this->view_path.'.index'),compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(parent::commonData($this->view_path.'.create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddFormRequest $request)
    {
        try{
            $request->request->add(['slug'=>Str::slug($request->name)]);
            if($request->icon==null)
            {
                $request->request->add(['icon'=>'fa-solid fa-lightbulb']);
            }
            Sector::create($request->all());
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
        return redirect()->back();
        // $data=[];
        // try{
        //     $data['data'] = Se::findOrFail($id);
        // }catch(Throwable $e){
        //     Session::flash('error', $e->getMessage());
        //     return redirect()->route($this->base_route.'.index');
        // }
        // return view(parent::commonData($this->view_path.'.show'),compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=[];
        try{
            $data['data'] = Sector::findOrFail($id);
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
            if($request->icon==null)
            {
                $request->request->add(['icon'=>'fa-solid fa-lightbulb']);
            }
            Sector::findOrFail($id)->update($request->all());
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
        try{
            Sector::findOrFail($id)->delete();
        }catch(Throwable $e){
            Session::flash('error', $e->getMessage());
            return redirect()->route($this->base_route.'.index');
        }
        Session::flash('error', Str::singular($this->panel).' Has Been Deleted');
        return redirect()->back();
    }
}
