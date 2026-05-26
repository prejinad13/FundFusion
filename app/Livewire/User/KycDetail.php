<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class KycDetail extends Component
{
    use WithFileUploads;

    public $detail, $data, $previewImageUrl, $previewImageName, $activeTab='personal_detail_tab',  $showImageModal=false;

    public $name, $phone, $sex, $dob, $father_name, $grand_father_name, $image, $temp_image;
    public $citizenship_number, $citizenship_issue_date, $citizenship_issue_district, $citizenship_front_document,$temp_citizenship_front_document, $citizenship_back_document,$temp_citizenship_back_document;

    public $district_lists;

    public $province, $district, $municipality, $ward, $locality;
    public $province_names, $district_names, $municipality_names;
    public $provinceSelected=false, $districtSelected=false;

    public $temporary_province, $temporary_district, $temporary_municipality, $temporary_ward, $temporary_locality;
    public $temporary_province_names, $temporary_district_names, $temporary_municipality_names;
    public $temporary_provinceSelected=false, $temporary_districtSelected=false;

    public $same_as_permanent=false;

    protected $listeners = ['refresh'];

    public function mount()
    {
        foreach (config('province') as $province => $provinceData) {
            foreach ($provinceData['districts'] as $district => $districtData) {
                $this->district_lists[] = $districtData['district'];
            }
        }
        $this->province_names=config('province');
        $this->temporary_province_names=config('province');
        $this->name=Auth::user()->name;
        $this->phone=Auth::user()->phone;
        $this->sex=Auth::user()->sex;
        $this->dob=Auth::user()->dob;
        $this->father_name=Auth::user()->father_name;
        $this->grand_father_name=Auth::user()->grand_father_name;
        $this->image=Auth::user()->image;
        $this->citizenship_number=Auth::user()->citizenship_number;
        $this->citizenship_issue_date=Auth::user()->citizenship_issue_date;
        $this->citizenship_issue_district=Auth::user()->citizenship_issue_district;
        $this->citizenship_front_document=Auth::user()->citizenship_front_document;
        $this->citizenship_back_document=Auth::user()->citizenship_back_document;
        $this->province=Auth::user()->province;
        $this->district=Auth::user()->district;
        $this->municipality=Auth::user()->municipality;
        $this->ward=Auth::user()->ward;
        $this->locality=Auth::user()->locality;
        $this->temporary_province=Auth::user()->temporary_province;
        $this->temporary_district=Auth::user()->temporary_district;
        $this->temporary_municipality=Auth::user()->temporary_municipality;
        $this->temporary_ward=Auth::user()->temporary_ward;
        $this->temporary_locality=Auth::user()->temporary_locality;
    }

    public function updated()
    {
        //For Same As Above
        if($this->same_as_permanent==true){
            $this->temporary_province=$this->province;
            $this->temporary_district=$this->district;
            $this->temporary_municipality=$this->municipality;
            $this->temporary_ward=$this->ward;
            $this->temporary_locality=$this->locality;
            if($this->province!=null){
                $this->temporary_provinceSelected=true;
                $this->temporary_province=$this->province;
                $this->temporary_district_names=$this->district_names;
            }
            if($this->district!=null){
                $this->temporary_districtSelected=true;
                $this->temporary_district=$this->district;
                $this->temporary_municipality_names=$this->municipality_names;
            }
            if($this->municipality!=null){
                $this->temporary_municipality=$this->municipality;
            }
        }
        //For District List
        if($this->province!=null){
            $this->provinceSelected=true;
            $this->district_names=config('province')[$this->province]['districts'];
        }
        else{
            $this->provinceSelected=false;
            $this->district=null;
            $this->district_names=null;
        }
        //For Local Level List
        if($this->district!=null && in_array($this->district,array_keys(config('province')[$this->province]['districts']))){
            $this->districtSelected=true;
            $this->municipality_names=config('province')[$this->province]['districts'][$this->district]['local_levels'];
        }else{
            $this->districtSelected=false;
            $this->municipality=null;
            $this->municipality_names=null;
        }
        //For Emergency District List
        if($this->temporary_province!=null){
            $this->temporary_provinceSelected=true;
            $this->temporary_district_names=config('province')[$this->temporary_province]['districts'];
        }
        else{
            $this->temporary_provinceSelected=false;
            $this->temporary_district=null;
            $this->temporary_district_names=null;
        }
        //For Emergency Local Level List
        if($this->temporary_district!=null && in_array($this->temporary_district,array_keys(config('province')[$this->temporary_province]['districts']))){
            $this->temporary_districtSelected=true;
            $this->temporary_municipality_names=config('province')[$this->temporary_province]['districts'][$this->temporary_district]['local_levels'];
        }else{
            $this->temporary_districtSelected=false;
            $this->temporary_municipality=null;
            $this->temporary_municipality_names=null;
        }
    }

    public function render()
    {
        $this->data=User::findOrFail(auth()->user()->id);
        return view('livewire.user.kyc-detail');
    }

    public function changeTab($tabName)
    {
        $this->activeTab=$tabName;
    }

    public function next()
    {
        switch ($this->activeTab) {
            case 'personal_detail_tab':
                $this->activeTab='address_detail_tab';
                break;

            case 'address_detail_tab':
                $this->activeTab='citizenship_detail_tab';
                break;
        }
    }

    public function previous()
    {
        switch ($this->activeTab) {
            case 'citizenship_detail_tab':
                $this->activeTab='address_detail_tab';
                break;

            case 'address_detail_tab':
                $this->activeTab='personal_detail_tab';
                break;
        }
    }

    public function openImageModal($picture)
    {
        switch ($picture) {
            case 'citizenship_front_image':
                $this->previewImageUrl=asset(Auth::user()->citizenship_front_document);
                $this->previewImageName="Citizenship Front";
                break;

            case 'citizenship_back_image':
                $this->previewImageUrl=asset(Auth::user()->citizenship_back_document);
                $this->previewImageName="Citizenship Back";
                break;

            case 'passport_photo':
                $this->previewImageUrl=asset(Auth::user()->image);
                $this->previewImageName="Passport Size Photo";
                break;
        }
        $this->showImageModal=true;
    }

    public function closeImageModal()
    {
        $this->showImageModal=false;
    }

    public function submit()
    {
        $this->validate([
            'name'=>'required',
            'phone'=>'required|digits:10|unique:users,phone,'.$this->data->id,
            'sex'=>'required',
            'dob' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'father_name'=>'required',
            'grand_father_name'=>'required',
            'temp_image'=>'required|mimes:png,jpg,jpeg|max:5555',
            'citizenship_number'=>'required|unique:users,citizenship_number,'.$this->data->id,
            'citizenship_issue_date'=>'required|date|before:tomorrow',
            'citizenship_issue_district'=>'required',
            'temp_citizenship_front_document'=>'required|mimes:png,jpg,jpeg|max:5555',
            'temp_citizenship_back_document'=>'required|mimes:png,jpg,jpeg|max:5555',
            'province'=>'required',
            'district'=>'required',
            'municipality'=>'required',
            'ward'=>'required',
            'locality'=>'required',
            'temporary_province'=>'required',
            'temporary_district'=>'required',
            'temporary_municipality'=>'required',
            'temporary_ward'=>'required',
            'temporary_locality'=>'required',
        ],
        [
            'name.required' => 'Name is required.',
            'phone.required' => 'Phone is required.',
            'phone.unique' => 'Phone number already exists.',
            'phone.digits' => 'Phone must be 10 digits.',
            'sex.required' => 'Sex is required.',
            'dob.required' => 'Date of birth is required.',
            'dob.date' => 'Please enter a valid date of birth.',
            'dob.before_or_equal' => 'You must be 18 years or older to register.',
            'father_name.required' => 'Father\'s name is required.',
            'grand_father_name.required' => 'Grandfather\'s name is required.',
            'temp_image.required' => 'Passport Photo is required.',
            'temp_image.mimes' => 'Supported Format PNG or JPG',
            'temp_image.max' => 'Passport Photo should be less than 5 MB.',
            'citizenship_number.required' => 'Citizenship number is required',
            'citizenship_number.unique' => 'Citizenship number already exists.',
            'citizenship_issue_date.required' => 'Citizenship issue date is required.',
            'citizenship_issue_date.date' => 'Please enter a valid date.',
            'citizenship_issue_date.before' => 'Please enter a valid date.',
            'citizenship_issue_district.required' => 'Citizenship issue district',
            'temp_citizenship_front_document.required' => 'Front document of citizenship is required.',
            'temp_citizenship_front_document.mimes' => 'Supported Format PNG or JPG',
            'temp_citizenship_front_document.max' => 'Citizenship (Front) should be less than 5 MB.',
            'temp_citizenship_back_document.required' => 'Back document of citizenship is required.',
            'temp_citizenship_back_document.mimes' => 'Supported Format PNG of JPG',
            'temp_citizenship_back_document.max' => 'Citizenship (Back) should be less than 5 MB.',
            'province.required' => 'Province is required.',
            'district.required' => 'District is required.',
            'municipality.required' => 'Municipality is required.',
            'ward.required' => 'Ward is required.',
            'locality.required' => 'Locality is required.',
            'temporary_province.required' => 'Temporary province is required.',
            'temporary_district.required' => 'Temporary district is required.',
            'temporary_municipality.required' => 'Temporary municipality is required.',
            'temporary_ward.required' => 'Temporary ward is required.',
            'temporary_locality.required' => 'Temporary locality is required.',
        ]);
        $uploadedPhoto = $this->temp_image->store('users/'.Str::slug($this->data->name).'-'.$this->data->id,'public');
        $uploadedCitizenshipFront = $this->temp_citizenship_front_document->store('users/'.Str::slug($this->data->name).'-'.$this->data->id,'public');
        $uploadedCitizenshipBack = $this->temp_citizenship_back_document->store('users/'.Str::slug($this->data->name).'-'.$this->data->id,'public');
        User::findOrFail($this->data->id)->update([
            'name'=>$this->name,
            'phone'=>$this->phone,
            'sex'=>$this->sex,
            'dob'=>$this->dob,
            'father_name'=>$this->father_name,
            'grand_father_name'=>$this->grand_father_name,
            'image'=>'storage/'.$uploadedPhoto,
            'citizenship_number'=>$this->citizenship_number,
            'citizenship_issue_date'=>$this->citizenship_issue_date,
            'citizenship_issue_district'=>$this->citizenship_issue_district,
            'citizenship_front_document'=>'storage/'.$uploadedCitizenshipFront,
            'citizenship_back_document'=>'storage/'.$uploadedCitizenshipBack,
            'province'=>$this->province,
            'district'=>$this->district,
            'municipality'=>$this->municipality,
            'ward'=>$this->ward,
            'locality'=>$this->locality,
            'temporary_province'=>$this->temporary_province,
            'temporary_district'=>$this->temporary_district,
            'temporary_municipality'=>$this->temporary_municipality,
            'temporary_ward'=>$this->temporary_ward,
            'temporary_locality'=>$this->temporary_locality,
            'kyc_status'=>'processing',
        ]);
        $this->dispatch('kyc_message');
    }
}
