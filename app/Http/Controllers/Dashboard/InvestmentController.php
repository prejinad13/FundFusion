<?php

namespace App\Http\Controllers\Dashboard;

use Throwable;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BaseController;

class InvestmentController extends BaseController
{

    protected  $base_route = 'dashboard.investments';
    protected  $view_path  = 'new-dashboard.investments';
    protected  $panel      = 'Investment';
    protected  $permission = 'investment';


    public function __construct()
    {
        $this->middleware('is_investor')->only(['investeeList','investeeProfile','investmentOpportunities','investmentOpportunitySingle']);
        $this->middleware('is_investee')->only(['investorList','investorProfile']);
        $this->middleware('kyc_verified')->only(['investmentOpportunities','investmentOpportunitySingle','investorList','investeeList','investorProfile','investeeProfile']);
    }


    public function investorList()
    {
        $this->panel="Investors";
        $data['data'] = User::with('roles')->get()->filter(fn($user)=>$user->roles->where('name','investor')->toArray());
        return view(parent::commonData($this->view_path.'.investors-list'),compact('data'));
    }

    public function investeeList()
    {
        $this->panel="Investees";
        $data['data'] = User::with('roles')->get()->filter(fn($user)=>$user->roles->where('name','investee')->toArray());
        return view(parent::commonData($this->view_path.'.investees-list'),compact('data'));
    }

    public function investmentOpportunities()
    {
        $this->panel="Investment Opportunities";
        $data['data'] = Idea::where('status','open')->orderBy('created_at','desc')->get();
        return view(parent::commonData($this->view_path.'.investment-opportunity'),compact('data'));
    }

    public function investmentOpportunitySingle($idea)
    {
       $data=[];
        try{
            $data['data'] = Idea::where('slug',$idea)->first();
        }catch(Throwable $e){
            Session::flash('error', $e->getMessage());
            return redirect()->back();
        }
        return view(parent::commonData($this->view_path.'.investment-opportunity-single'),compact('data'));
    }

    public function investorProfile($id)
    {
        $data=[];
        try{
            $data['data'] = User::findOrFail($id);
        }catch(Throwable $e){
            Session::flash('error', $e->getMessage());
            return redirect()->back();
        }
        return view(parent::commonData($this->view_path.'.investor-profile'),compact('data'));
    }

    public function investeeProfile($id)
    {
        $data=[];
        try{
            $data['data'] = User::findOrFail($id);
        }catch(Throwable $e){
            Session::flash('error', $e->getMessage());
            return redirect()->back();
        }
        return view(parent::commonData($this->view_path.'.investee-profile'),compact('data'));
    }

}
