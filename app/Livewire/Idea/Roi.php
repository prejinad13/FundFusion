<?php

namespace App\Livewire\Idea;

use Livewire\Component;

class Roi extends Component
{
    public $required_investment_amount, $estimated_return, $return_on_investment;

    // public function mount()
    // {
    //     dd($this->require);
    // }

    public function updated()
    {
        $this->validate(['required_investment_amount'=>'required|not_in:0'],['required_investment_amount.required'=>'Enter Required Investment Amount','required_investment_amount.not_in'=>'Amount must be greater than 0']);
        if($this->required_investment_amount!=0 && $this->estimated_return!=0){
            $roi= (($this->estimated_return-$this->required_investment_amount)/$this->required_investment_amount)*100;
            $this->return_on_investment=number_format($roi,2);
        }
    }

    public function render()
    {
        return view('livewire.idea.roi');
    }
}
