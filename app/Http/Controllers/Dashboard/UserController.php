<?php

namespace App\Http\Controllers\Dashboard;

use Throwable;
use App\Models\User;
use App\Models\Sector;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BaseController;

class UserController extends BaseController
{

    protected  $base_route = 'dashboard.users';
    protected  $view_path  = 'new-dashboard.users';
    protected  $panel      = 'User';
    protected  $permission = 'user';

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
        $this->panel="All Users";
        $data['data'] = User::orderBy('created_at','desc')->get();
        return view(parent::commonData($this->view_path.'.index'),compact('data'));
    }

    public function verifiedUser()
    {
        $this->panel="KYC Verified Users";
        $data['data'] = User::orderBy('created_at','desc')->where('kyc_status','verified')->get();
        return view(parent::commonData($this->view_path.'.index'),compact('data'));
    }

    public function unverifiedUser()
    {
        $this->panel="KYC Unverified Users";
        $data['data'] = User::orderBy('created_at','desc')->where('kyc_status','!=','verified')->get();
        return view(parent::commonData($this->view_path.'.index'),compact('data'));
    }

    public function kycDetail()
    {
        $data['data'] = User::findOrFail(auth()->user()->id);
        $data['interests'] = Sector::all();
        $this->panel= "My Profile";
        return view(parent::commonData($this->view_path.'.kyc-detail'),compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->back();
        // return view(parent::commonData($this->view_path.'.create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->back();
    //     try{
    //         Feature::create($request->all());
    //     }catch(Throwable $e){
    //         Session::flash('error', $e->getMessage());
    //         return redirect()->route($this->base_route.'.index');
    //     }
    //    Session::flash('success', Str::singular($this->panel).' Is Successfully Saved');
    //    return redirect()->route($this->base_route.'.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=[];
        try{
            $data['data'] = User::findOrFail($id);
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
        return redirect()->back();
        // $data=[];
        // try{
        //     $data['data'] = Feature::findOrFail($id);
        // }catch(Throwable $e){
        //     Session::flash('error', $e->getMessage());
        //     return redirect()->route($this->base_route.'.index');
        // }
        // return view(parent::commonData($this->view_path.'.edit'),compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(Auth::user()->roles()->first()->name=='investor'){
            $request->validate(['max_investment_amount'=>'required','description'=>'required','interest'=>'required'],['max_investment_amount.required'=>'Max Investment Amount Required','description.required'=>'Enter your description','interest.required'=>'Select Area of Interest']);
        }else{
            $request->validate(['description'=>'required','interest'=>'required'],['description.required'=>'Enter your description','interest.required'=>'Select Area of Interest']);
        }

        try{
            if ($request->get('interest')) {
                $user=User::find($id);
                $user->sectors()->sync($request->input('interest'));
            } else {
                User::find($id)->sectors()->detach();
            }
                User::findOrFail($id)->update($request->all());
        }catch(Throwable $e){
            Session::flash('error', $e->getMessage());
            return redirect()->route($this->base_route.'.index');
        }
        Session::flash('success', Str::singular($this->panel).' Is Successfully Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            User::findOrFail($id)->delete();
        }catch(Throwable $e){
            Session::flash('error', $e->getMessage());
            return redirect()->route($this->base_route.'.index');
        }
        Session::flash('error', Str::singular($this->panel).' Has Been Deleted');
        return redirect()->back();
    }
}
