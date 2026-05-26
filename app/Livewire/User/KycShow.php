<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class KycShow extends Component
{
    public $data,$previewImageUrl, $previewImageName, $activeTab='personal_detail_tab',  $showImageModal=false, $kyc_remarks,$showModal=false;

    public $company_address,$company_registration_date, $company_registration_number, $pan_number, $company_registration_certificate,$temp_company_registration_certificate, $company_pan_certificate,$temp_company_pan_certificate;

    public $name, $phone, $sex, $dob, $father_name, $grand_father_name, $image;
    public $citizenship_number, $citizenship_issue_date, $citizenship_issue_district, $citizenship_front_document, $citizenship_back_document;
    public $province, $district, $municipality, $ward, $locality;
    public $temporary_province, $temporary_district, $temporary_municipality, $temporary_ward, $temporary_locality;

    protected $listeners = ['refresh','verifyKyc','rejectKyc','closeModal'];

    public function mount()
    {
        if($this->data->account_type=='company'){
            $this->activeTab='company_detail_tab';
        }
        $this->name=$this->data->name;
        $this->phone=$this->data->phone;
        $this->sex=$this->data->sex;
        $this->dob=$this->data->dob;
        $this->father_name=$this->data->father_name;
        $this->grand_father_name=$this->data->grand_father_name;
        $this->image=$this->data->image;
        $this->citizenship_number=$this->data->citizenship_number;
        $this->citizenship_issue_date=$this->data->citizenship_issue_date;
        $this->citizenship_issue_district=$this->data->citizenship_issue_district;
        $this->citizenship_front_document=$this->data->citizenship_front_document;
        $this->citizenship_back_document=$this->data->citizenship_back_document;
        $this->province=$this->data->province;
        $this->district=$this->data->district;
        $this->municipality=$this->data->municipality;
        $this->ward=$this->data->ward;
        $this->locality=$this->data->locality;
        $this->temporary_province=$this->data->temporary_province;
        $this->temporary_district=$this->data->temporary_district;
        $this->temporary_municipality=$this->data->temporary_municipality;
        $this->temporary_ward=$this->data->temporary_ward;
        $this->temporary_locality=$this->data->temporary_locality;
        $this->company_address=$this->data->company_address;
        $this->company_registration_number=$this->data->company_registration_number;
        $this->company_registration_date=$this->data->company_registration_date;
        $this->pan_number=$this->data->pan_number;

    }

    public function render()
    {
        return view('livewire.user.kyc-show');
    }

    public function confirmKycVerify()
    {
        $this->dispatch('confirm_kyc_verification');
    }

    public function verifyKyc()
    {
        User::findOrFail($this->data->id)->update(['kyc_status'=>'verified']);
        $this->dispatch('kyc_status');
    }

    public function openModal()
    {
        $this->showModal=true;
    }

    public function closeModal()
    {
        $this->showModal=false;
        $this->kyc_remarks=null;
    }

    public function kycRemarkSubmit()
    {
        $this->validate(['kyc_remarks'=>'required'],['kyc_remarks.required'=>'Please enter valid remarks.']);
        $this->showModal=false;
        $this->dispatch('confirm_kyc_rejection');
    }

    public function rejectKyc()
    {
        User::findOrFail($this->data->id)->update(['kyc_status'=>'rejected','kyc_remarks'=>$this->kyc_remarks]);
        $this->dispatch('kyc_rejected');
    }

    public function changeTab($tabName)
    {
        $this->activeTab=$tabName;
    }

    public function next()
    {
        if($this->data->account_type=='company'){
            switch ($this->activeTab) {
                case 'company_detail_tab':
                    $this->activeTab='company_document_tab';
                    break;

                case 'company_document_tab':
                    $this->activeTab='company_detail_tab';
                    break;
            }
        }

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
        if($this->data->account_type=='company'){
            switch ($this->activeTab) {
                case 'company_document_tab':
                    $this->activeTab='company_detail_tab';
                    break;

                case 'company_detail_tab':
                    $this->activeTab='company_document_tab';
                    break;
            }
        }

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
        if($this->data->account_type=='company'){
            switch ($picture) {
                case 'citizenship_front_image':
                    $this->previewImageUrl=asset($this->data->company_registration_certificate);
            $this->previewImageName="Company Registration Certificate";
                    break;

                case 'citizenship_back_image':
                    $this->previewImageUrl=asset($this->data->company_pan_certificate);
                    $this->previewImageName="Company PAN Certificate";
                    break;

                case 'passport_photo':
                    $this->previewImageUrl=asset($this->data->image);
                    $this->previewImageName="Company Logo";
                    break;
            }
            $this->showImageModal=true;
        }else{
            switch ($picture) {
                case 'citizenship_front_image':
                    $this->previewImageUrl=asset($this->data->citizenship_front_document);
                    $this->previewImageName="Citizenship Front";
                    break;

                case 'citizenship_back_image':
                    $this->previewImageUrl=asset($this->data->citizenship_back_document);
                    $this->previewImageName="Citizenship Back";
                    break;

                case 'passport_photo':
                    $this->previewImageUrl=asset($this->data->image);
                    $this->previewImageName="Passport Size Photo";
                    break;
            }
            $this->showImageModal=true;
        }


    }

    public function closeImageModal()
    {
        $this->showImageModal=false;
    }
}
