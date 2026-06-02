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
        $investee = auth()->user();
        
        $investeeSectorIds = $investee->sectors->pluck('id')->toArray();
        $investors = User::with('roles', 'sectors')->get()->filter(fn($user)=>$user->roles->where('name','investor')->toArray());
        $allSectorIds = \App\Models\Sector::pluck('id')->toArray();
        
        $vectorA = [];
        foreach ($allSectorIds as $sectorId) {
            $vectorA[$sectorId] = in_array($sectorId, $investeeSectorIds) ? 1 : 0;
        }
        
        $sumSqA = 0;
        foreach ($vectorA as $val) {
            $sumSqA += $val * $val;
        }
        $magnitudeA = sqrt($sumSqA);
        
        foreach ($investors as $investor) {
            $investorSectorIds = $investor->sectors->pluck('id')->toArray();
            
            $vectorB = [];
            foreach ($allSectorIds as $sectorId) {
                $vectorB[$sectorId] = in_array($sectorId, $investorSectorIds) ? 1 : 0;
            }
            
            $dotProduct = 0;
            foreach ($allSectorIds as $sectorId) {
                $dotProduct += $vectorA[$sectorId] * $vectorB[$sectorId];
            }
            
            $sumSqB = 0;
            foreach ($vectorB as $val) {
                $sumSqB += $val * $val;
            }
            $magnitudeB = sqrt($sumSqB);
            
            if ($magnitudeA > 0 && $magnitudeB > 0) {
                $similarity = $dotProduct / ($magnitudeA * $magnitudeB);
            } else {
                $similarity = 0.0;
            }
            
            $investor->similarity_score = $similarity;
        }
        
        $investors = $investors->sort(function ($a, $b) {
            if ($a->similarity_score == $b->similarity_score) {
                $timeA = $a->created_at ? $a->created_at->timestamp : 0;
                $timeB = $b->created_at ? $b->created_at->timestamp : 0;
                return $timeB <=> $timeA;
            }
            return $b->similarity_score <=> $a->similarity_score;
        });
        
        $data['data'] = $investors;
        
        return view(parent::commonData($this->view_path.'.investors-list'),compact('data'));
    }

    public function investeeList()
    {
        $this->panel="Investees";
        $investor = auth()->user();
        
        $investorSectorIds = $investor->sectors->pluck('id')->toArray();
        $investees = User::with('roles', 'sectors')->get()->filter(fn($user)=>$user->roles->where('name','investee')->toArray());
        $allSectorIds = \App\Models\Sector::pluck('id')->toArray();
        
        $vectorA = [];
        foreach ($allSectorIds as $sectorId) {
            $vectorA[$sectorId] = in_array($sectorId, $investorSectorIds) ? 1 : 0;
        }
        
        $sumSqA = 0;
        foreach ($vectorA as $val) {
            $sumSqA += $val * $val;
        }
        $magnitudeA = sqrt($sumSqA);
        
        foreach ($investees as $investee) {
            $investeeSectorIds = $investee->sectors->pluck('id')->toArray();
            
            $vectorB = [];
            foreach ($allSectorIds as $sectorId) {
                $vectorB[$sectorId] = in_array($sectorId, $investeeSectorIds) ? 1 : 0;
            }
            
            $dotProduct = 0;
            foreach ($allSectorIds as $sectorId) {
                $dotProduct += $vectorA[$sectorId] * $vectorB[$sectorId];
            }
            
            $sumSqB = 0;
            foreach ($vectorB as $val) {
                $sumSqB += $val * $val;
            }
            $magnitudeB = sqrt($sumSqB);
            
            if ($magnitudeA > 0 && $magnitudeB > 0) {
                $similarity = $dotProduct / ($magnitudeA * $magnitudeB);
            } else {
                $similarity = 0.0;
            }
            
            $investee->similarity_score = $similarity;
        }
        
        $investees = $investees->sort(function ($a, $b) {
            if ($a->similarity_score == $b->similarity_score) {
                $timeA = $a->created_at ? $a->created_at->timestamp : 0;
                $timeB = $b->created_at ? $b->created_at->timestamp : 0;
                return $timeB <=> $timeA;
            }
            return $b->similarity_score <=> $a->similarity_score;
        });
        
        $data['data'] = $investees;
        
        return view(parent::commonData($this->view_path.'.investees-list'),compact('data'));
    }

    public function investmentOpportunities()
    {
        $this->panel="Investment Opportunities";
        $investor = auth()->user();
        
        $investorSectorIds = $investor->sectors->pluck('id')->toArray();
        $ideas = Idea::where('status', 'open')->with('sectors', 'investee')->get();
        $allSectorIds = \App\Models\Sector::pluck('id')->toArray();
        
        $vectorA = [];
        foreach ($allSectorIds as $sectorId) {
            $vectorA[$sectorId] = in_array($sectorId, $investorSectorIds) ? 1 : 0;
        }
        
        $sumSqA = 0;
        foreach ($vectorA as $val) {
            $sumSqA += $val * $val;
        }
        $magnitudeA = sqrt($sumSqA);
        
        foreach ($ideas as $idea) {
            $ideaSectorIds = $idea->sectors->pluck('id')->toArray();
            
            $vectorB = [];
            foreach ($allSectorIds as $sectorId) {
                $vectorB[$sectorId] = in_array($sectorId, $ideaSectorIds) ? 1 : 0;
            }
            
            $dotProduct = 0;
            foreach ($allSectorIds as $sectorId) {
                $dotProduct += $vectorA[$sectorId] * $vectorB[$sectorId];
            }
            
            $sumSqB = 0;
            foreach ($vectorB as $val) {
                $sumSqB += $val * $val;
            }
            $magnitudeB = sqrt($sumSqB);
            
            if ($magnitudeA > 0 && $magnitudeB > 0) {
                $similarity = $dotProduct / ($magnitudeA * $magnitudeB);
            } else {
                $similarity = 0.0;
            }
            
            $idea->similarity_score = $similarity;
        }
        
        $ideas = $ideas->sort(function ($a, $b) {
            if ($a->similarity_score == $b->similarity_score) {
                $timeA = $a->created_at ? $a->created_at->timestamp : 0;
                $timeB = $b->created_at ? $b->created_at->timestamp : 0;
                return $timeB <=> $timeA;
            }
            return $b->similarity_score <=> $a->similarity_score;
        });
        
        $data['data'] = $ideas;
        
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
