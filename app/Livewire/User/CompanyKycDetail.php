<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CompanyKycDetail extends Component
{
    use WithFileUploads;

    public $detail, $data, $previewImageUrl, $previewImageName, $activeTab='company_detail_tab',  $showImageModal=false;

    public $name, $phone, $company_address, $company_registration_date, $company_registration_number, $pan_number, $image, $temp_image;
    public $company_registration_certificate,$temp_company_registration_certificate, $company_pan_certificate,$temp_company_pan_certificate;

    protected $listeners = ['refresh'];

    public function mount()
    {
        $this->name=Auth::user()->name;
        $this->phone=Auth::user()->phone;
        $this->company_address=Auth::user()->company_address;
        $this->company_registration_date=Auth::user()->company_registration_date;
        $this->company_registration_number=Auth::user()->company_registration_number;
        $this->pan_number=Auth::user()->pan_number;
        $this->image=Auth::user()->image;
        $this->company_registration_certificate=Auth::user()->company_registration_certificate;
        $this->company_pan_certificate=Auth::user()->company_pan_certificate;
    }


    public function render()
    {
        $this->data=User::findOrFail(auth()->user()->id);
        return view('livewire.user.company-kyc-detail');
    }

    public function changeTab($tabName)
    {
        $this->activeTab=$tabName;
    }

    public function next()
    {
        switch ($this->activeTab) {
            case 'company_detail_tab':
                $this->activeTab='company_document_tab';
                break;

            case 'company_document_tab':
                $this->activeTab='company_detail_tab';
                break;
        }
    }

    public function previous()
    {
        switch ($this->activeTab) {
            case 'company_document_tab':
                $this->activeTab='company_detail_tab';
                break;

            case 'company_detail_tab':
                $this->activeTab='company_document_tab';
                break;
        }
    }

    public function openImageModal($picture)
    {
        switch ($picture) {
            case 'citizenship_front_image':
                $this->previewImageUrl=asset(Auth::user()->company_registration_certificate);
                $this->previewImageName="Company Registration Certificate";
                break;

            case 'citizenship_back_image':
                $this->previewImageUrl=asset(Auth::user()->company_pan_certificate);
                $this->previewImageName="Company PAN Certificate";
                break;

            case 'passport_photo':
                $this->previewImageUrl=asset(Auth::user()->image);
                $this->previewImageName="Company Logo";
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
            'company_address'=>'required',
            'phone'=>'required|digits:10|unique:users,phone,'.$this->data->id,
            'company_registration_date' => 'required|date|before_or_equal:' . now(),
            'temp_image'=>'required|mimes:png,jpg,jpeg|max:5555',
            'company_registration_number'=>'required|unique:users,company_registration_number,'.$this->data->id,
            'pan_number'=>'required|unique:users,pan_number,'.$this->data->id,
            'temp_company_registration_certificate'=>'required|mimes:png,jpg,jpeg|max:5555',
            'temp_company_pan_certificate'=>'required|mimes:png,jpg,jpeg|max:5555',
        ],
        [
            'name.required' => 'Name is required.',
            'phone.required' => 'Phone is required.',
            'phone.unique' => 'Phone number already taken.',
            'phone.digits' => 'Phone must be 10 digits.',
            'company_address.required' => 'Company Address is required.',
            'company_registration_date.required' => 'Company Registration Date is required.',
            'company_registration_date.date' => 'Please enter a valid registration date.',
            'company_registration_date.before_or_equal' => 'Please enter a valid registration date.',
            'temp_image.required' => 'Company Logo is required.',
            'temp_image.mimes' => 'Supported Format PNG or JPG',
            'temp_image.max' => 'Company Logo should be less than 5 MB.',
            'company_registration_number.required' => 'Company registration number is required',
            'company_registration_number.unique' => 'Company registration number already exists.',
            'pan_number.required' => 'PAN number is required.',
            'pan_number.unique' => 'PAN number already exists.',
            'temp_company_registration_certificate.required' => 'Company Registration Certificate is required.',
            'temp_company_registration_certificate.mimes' => 'Supported Format PNG or JPG',
            'temp_company_registration_certificate.max' => 'Company Registration Certificate should be less than 5 MB.',
            'temp_company_pan_certificate.required' => 'Company PAN is required.',
            'temp_company_pan_certificate.mimes' => 'Supported Format PNG of JPG',
            'temp_company_pan_certificate.max' => 'Company PAN should be less than 5 MB.',
        ]);
        $uploadedPhoto = $this->temp_image->store('users/'.Str::slug($this->data->name).'-'.$this->data->id,'public');
        $uploadedCompanyRegistration = $this->temp_company_registration_certificate->store('users/'.Str::slug($this->data->name).'-'.$this->data->id,'public');
        $uploadedCompanyPan = $this->temp_company_pan_certificate->store('users/'.Str::slug($this->data->name).'-'.$this->data->id,'public');
        User::findOrFail($this->data->id)->update([
            'name'=>$this->name,
            'phone'=>$this->phone,
            'company_address'=>$this->company_address,
            'company_registration_date'=>$this->company_registration_date,
            'image'=>'storage/'.$uploadedPhoto,
            'company_registration_number'=>$this->company_registration_number,
            'pan_number'=>$this->pan_number,
            'company_registration_certificate'=>'storage/'.$uploadedCompanyRegistration,
            'company_pan_certificate'=>'storage/'.$uploadedCompanyPan,
            'kyc_status'=>'processing',
        ]);
        $this->dispatch('kyc_message');
    }
}


