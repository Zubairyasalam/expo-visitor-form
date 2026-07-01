@extends('layouts.app')

@section('title', 'Visitor Registration - My India Living')

@section('content')
@php
    $standardCategories = $settings['categories'] ?? ['Real Estate', 'Engineer/Contractor', 'Maintenance Services', 'Health Care', 'Education', 'Tours and Hospitality', 'Professional Services', 'Products'];
    $isCustomCategory = old('business_category') && !in_array(old('business_category'), $standardCategories);

    $standardDistricts = $settings['districts'] ?? ['Ariyalur', 'Chengalpattu', 'Chennai', 'Coimbatore', 'Cuddalore', 'Dharmapuri', 'Dindigul', 'Erode', 'Kallakurichi', 'Kancheepuram', 'Kanniyakumari', 'Karur', 'Krishnagiri', 'Madurai', 'Mayiladuthurai', 'Nagapattinam', 'Namakkal', 'Nilgiris', 'Perambalur', 'Pudukkottai', 'Ramanathapuram', 'Ranipet', 'Salem', 'Sivaganga', 'Tenkasi', 'Thanjavur', 'Theni', 'Thoothukudi', 'Tiruchirappalli', 'Tirunelveli', 'Tirupattur', 'Tiruppur', 'Tiruvallur', 'Tiruvannamalai', 'Tiruvarur', 'Vellore', 'Viluppuram', 'Virudhunagar'];
    $isCustomDistrict = old('district') && !in_array(old('district'), $standardDistricts);
@endphp
<div class="container">
    <div class="card">
        <div style="text-align: center; margin-bottom: 1.25rem;">
            <img src="{{ asset('mil-logo-with-tagline-bg.jpg') }}?v={{ time() }}" alt="My India Living Logo" style="height: 55px; width: auto; display: inline-block;">
        </div>
        <h1 class="card-title">{{ $settings['registration_title'] ?? 'Expo Registration Form' }}</h1>
        <p class="card-subtitle">{{ $settings['registration_subtitle'] ?? 'Please fill in your details to register as a visitor' }}</p>

        @if ($errors->any())
            <div style="background-color: #FFF5F5; border: 1px solid #FED7D7; color: #C53030; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <p style="font-weight: 700; margin-bottom: 0.5rem;">Please correct the errors below:</p>
                <ul style="list-style-position: inside; font-size: 0.9rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('visitor.store') }}" method="POST" id="visitorForm">
            @csrf

            <!-- Name of Visitor -->
            @if($settings['fields']['name']['enabled'] ?? true)
            <div class="form-group">
                <label for="name" class="form-label">{{ $settings['fields']['name']['label'] ?? 'Name of Visitor' }} @if($settings['fields']['name']['required'] ?? true) <span class="required">*</span> @endif</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="{{ $settings['fields']['name']['placeholder'] ?? 'Enter your full name' }}" {{ ($settings['fields']['name']['required'] ?? true) ? 'required' : '' }}>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @endif

            <!-- Mobile Number -->
            @if($settings['fields']['mobile_number']['enabled'] ?? true)
            <div class="form-group">
                <label for="mobile_number" class="form-label">{{ $settings['fields']['mobile_number']['label'] ?? 'Mobile Number' }} @if($settings['fields']['mobile_number']['required'] ?? true) <span class="required">*</span> @endif</label>
                <input type="tel" name="mobile_number" id="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number') }}" placeholder="{{ $settings['fields']['mobile_number']['placeholder'] ?? 'Enter 10-digit mobile number' }}" pattern="[0-9]{10,15}" {{ ($settings['fields']['mobile_number']['required'] ?? true) ? 'required' : '' }}>
                @error('mobile_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @endif

            <!-- WhatsApp Number -->
            @if($settings['fields']['whatsapp_number']['enabled'] ?? true)
            <div class="form-group">
                <label for="whatsapp_number" class="form-label">{{ $settings['fields']['whatsapp_number']['label'] ?? 'WhatsApp Number' }} @if($settings['fields']['whatsapp_number']['required'] ?? false) <span class="required">*</span> @endif</label>
                <input type="tel" name="whatsapp_number" id="whatsapp_number" class="form-control @error('whatsapp_number') is-invalid @enderror" value="{{ old('whatsapp_number') }}" placeholder="{{ $settings['fields']['whatsapp_number']['placeholder'] ?? 'Enter WhatsApp number (Optional)' }}" pattern="[0-9]{10,15}" {{ ($settings['fields']['whatsapp_number']['required'] ?? false) ? 'required' : '' }}>
                <div style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--text-secondary); display: flex; align-items: center; gap: 5px;">
                    <input type="checkbox" id="sameAsMobile" style="cursor: pointer;">
                    <label for="sameAsMobile" style="cursor: pointer; user-select: none;">Same as Mobile Number</label>
                </div>
                @error('whatsapp_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @endif

            <!-- State -->
            @if($settings['fields']['state']['enabled'] ?? true)
            <div class="form-group">
                <label for="state" class="form-label">{{ $settings['fields']['state']['label'] ?? 'State' }} @if($settings['fields']['state']['required'] ?? true) <span class="required">*</span> @endif</label>
                <select name="state" id="state" class="form-control @error('state') is-invalid @enderror" {{ ($settings['fields']['state']['required'] ?? true) ? 'required' : '' }}>
                    <option value="" disabled {{ old('state') == '' ? 'selected' : '' }}>Choose</option>
                    @foreach($settings['states'] ?? ['Tamil Nadu', 'Other State'] as $st)
                        <option value="{{ $st }}" {{ old('state') == $st ? 'selected' : '' }}>{{ $st }}</option>
                    @endforeach
                </select>
                @error('state')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @endif

            <!-- Select District (Tamil Nadu) -->
            @if(($settings['fields']['state']['enabled'] ?? true) && ($settings['fields']['district']['enabled'] ?? true))
            <div id="districtSection" class="form-group">
                <label for="district" class="form-label">{{ $settings['fields']['district']['label'] ?? 'Select District (Tamil Nadu)' }} @if($settings['fields']['district']['required'] ?? true) <span class="required">*</span> @endif</label>
                <select name="district" id="district" class="form-control @error('district') is-invalid @enderror">
                    <option value="" disabled {{ (!old('district') && !$isCustomDistrict) ? 'selected' : '' }}>Choose</option>
                    @foreach($standardDistricts as $dist)
                        <option value="{{ $dist }}" {{ old('district') == $dist ? 'selected' : '' }}>{{ $dist }}</option>
                    @endforeach
                    <option value="Other" {{ ($isCustomDistrict || old('district') == 'Other') ? 'selected' : '' }}>Other District...</option>
                </select>
                @error('district')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Custom District Input (shown when "Other" is selected) -->
            <div id="customDistrictSection" class="form-group conditional-section">
                <label for="custom_district" class="form-label">Specify District <span class="required">*</span></label>
                <input type="text" id="custom_district" class="form-control" placeholder="Enter custom district name" value="{{ $isCustomDistrict ? old('district') : '' }}">
            </div>
            @endif

            <!-- If other State (Name of the State) - Dynamic -->
            @if($settings['fields']['state']['enabled'] ?? true)
            <div id="otherStateSection" class="form-group conditional-section">
                <label for="other_state_name" class="form-label">Name of the State <span class="required">*</span></label>
                <input type="text" name="other_state_name" id="other_state_name" class="form-control @error('other_state_name') is-invalid @enderror" value="{{ old('other_state_name') }}" placeholder="Enter state name">
                @error('other_state_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @endif

            <!-- Business Name -->
            @if($settings['fields']['business_name']['enabled'] ?? true)
            <div class="form-group">
                <label for="business_name" class="form-label">{{ $settings['fields']['business_name']['label'] ?? 'Business Name' }} @if($settings['fields']['business_name']['required'] ?? true) <span class="required">*</span> @endif</label>
                <input type="text" name="business_name" id="business_name" class="form-control @error('business_name') is-invalid @enderror" value="{{ old('business_name') }}" placeholder="{{ $settings['fields']['business_name']['placeholder'] ?? 'Enter your business/company name' }}" {{ ($settings['fields']['business_name']['required'] ?? true) ? 'required' : '' }}>
                @error('business_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @endif

            <!-- Business Category -->
            @if($settings['fields']['business_category']['enabled'] ?? true)
            <div class="form-group">
                <label for="business_category" class="form-label">{{ $settings['fields']['business_category']['label'] ?? 'Business Category' }} @if($settings['fields']['business_category']['required'] ?? true) <span class="required">*</span> @endif</label>
                <select name="business_category" id="business_category" class="form-control @error('business_category') is-invalid @enderror" {{ ($settings['fields']['business_category']['required'] ?? true) ? 'required' : '' }}>
                    <option value="" disabled {{ (!old('business_category') && !$isCustomCategory) ? 'selected' : '' }}>Choose</option>
                    @foreach($standardCategories as $cat)
                        <option value="{{ $cat }}" {{ old('business_category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                    <option value="Other" {{ ($isCustomCategory || old('business_category') == 'Other') ? 'selected' : '' }}>Other Category...</option>
                </select>
                @error('business_category')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Custom Business Category Input (shown when "Other" is selected) -->
            <div id="customCategorySection" class="form-group conditional-section">
                <label for="custom_business_category" class="form-label">Specify Business Category <span class="required">*</span></label>
                <input type="text" id="custom_business_category" class="form-control" placeholder="Enter custom business category" value="{{ $isCustomCategory ? old('business_category') : '' }}">
            </div>
            @endif

            <!-- Business Activity -->
            @if($settings['fields']['business_activity']['enabled'] ?? true)
            <div class="form-group">
                <label for="business_activity" class="form-label">{{ $settings['fields']['business_activity']['label'] ?? 'Business Activity' }} @if($settings['fields']['business_activity']['required'] ?? true) <span class="required">*</span> @endif</label>
                <input type="text" name="business_activity" id="business_activity" class="form-control @error('business_activity') is-invalid @enderror" value="{{ old('business_activity') }}" placeholder="{{ $settings['fields']['business_activity']['placeholder'] ?? 'Enter your business activity' }}" {{ ($settings['fields']['business_activity']['required'] ?? true) ? 'required' : '' }}>
                @error('business_activity')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @endif

            <!-- Have you Website -->
            @if($settings['fields']['has_website']['enabled'] ?? true)
            <div class="form-group">
                <label class="form-label">{{ $settings['fields']['has_website']['label'] ?? 'Do you have a Website?' }} @if($settings['fields']['has_website']['required'] ?? true) <span class="required">*</span> @endif</label>
                <div class="radio-group-grid">
                    <div class="radio-card" id="web_yes_card">
                        <input type="radio" name="has_website" id="has_website_yes" value="1" {{ old('has_website') == '1' ? 'checked' : '' }} {{ ($settings['fields']['has_website']['required'] ?? true) ? 'required' : '' }}>
                        Yes
                    </div>
                    <div class="radio-card" id="web_no_card">
                        <input type="radio" name="has_website" id="has_website_no" value="0" {{ old('has_website') == '0' ? 'checked' : '' }} {{ ($settings['fields']['has_website']['required'] ?? true) ? 'required' : '' }}>
                        No
                    </div>
                </div>
                @error('has_website')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Custom Website URL Input (shown when "Yes" is selected) -->
            <div id="websiteUrlSection" class="form-group conditional-section">
                <label for="website_url" class="form-label">Website URL <span class="required">*</span></label>
                <input type="text" name="website_url" id="website_url" class="form-control @error('website_url') is-invalid @enderror" value="{{ old('website_url') }}" placeholder="Enter website URL (e.g., https://example.com)">
                <span id="website_url_client_error" class="text-danger" style="display: none; font-weight: 500; margin-top: 0.25rem;">Give a valid URL</span>
                @error('website_url')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @endif

            <!-- Are you Interested in Create a webpage under Myindialiving.com -->
            @if($settings['fields']['interested_in_webpage']['enabled'] ?? true)
            <div class="form-group">
                <label class="form-label">{{ $settings['fields']['interested_in_webpage']['label'] ?? 'Are you interested in creating a webpage under Myindialiving.com?' }} @if($settings['fields']['interested_in_webpage']['required'] ?? true) <span class="required">*</span> @endif</label>
                <div class="radio-group-grid">
                    <div class="radio-card" id="interest_yes_card">
                        <input type="radio" name="interested_in_webpage" id="interested_in_webpage_yes" value="1" {{ old('interested_in_webpage') == '1' ? 'checked' : '' }} {{ ($settings['fields']['interested_in_webpage']['required'] ?? true) ? 'required' : '' }}>
                        Yes
                    </div>
                    <div class="radio-card" id="interest_no_card">
                        <input type="radio" name="interested_in_webpage" id="interested_in_webpage_no" value="0" {{ old('interested_in_webpage') == '0' ? 'checked' : '' }} {{ ($settings['fields']['interested_in_webpage']['required'] ?? true) ? 'required' : '' }}>
                        No
                    </div>
                </div>
                @error('interested_in_webpage')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @endif

            <!-- Custom Dynamic Fields -->
            @foreach($settings['fields'] ?? [] as $key => $field)
                @if(!in_array($key, ['name', 'mobile_number', 'whatsapp_number', 'state', 'district', 'business_name', 'business_category', 'business_activity', 'has_website', 'interested_in_webpage']))
                    @if($field['enabled'] ?? true)
                        <div class="form-group">
                            <label for="custom_{{ $key }}" class="form-label">{{ $field['label'] }} @if($field['required'] ?? false) <span class="required">*</span> @endif</label>
                            <input type="text" name="custom_fields[{{ $key }}]" id="custom_{{ $key }}" class="form-control @error('custom_fields.'.$key) is-invalid @enderror" placeholder="{{ $field['placeholder'] ?? '' }}" {{ ($field['required'] ?? false) ? 'required' : '' }} value="{{ old('custom_fields.'.$key) }}">
                            @error('custom_fields.'.$key)
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                @endif
            @endforeach

            <!-- Submit Button -->
            <button type="submit" class="btn-submit" id="submitBtn">{{ $settings['submit_button_text'] ?? 'Submit Registration' }}</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stateSelect = document.getElementById('state');
    const districtSection = document.getElementById('districtSection');
    const districtSelect = document.getElementById('district');
    const customDistrictSection = document.getElementById('customDistrictSection');
    const customDistrictInput = document.getElementById('custom_district');
    const otherStateSection = document.getElementById('otherStateSection');
    const otherStateInput = document.getElementById('other_state_name');

    const businessCategory = document.getElementById('business_category');
    const customCategorySection = document.getElementById('customCategorySection');
    const customCategoryInput = document.getElementById('custom_business_category');

    const hasWebsiteYes = document.getElementById('has_website_yes');
    const hasWebsiteNo = document.getElementById('has_website_no');
    const websiteUrlSection = document.getElementById('websiteUrlSection');
    const websiteUrlInput = document.getElementById('website_url');

    const mobileNumber = document.getElementById('mobile_number');
    const whatsappNumber = document.getElementById('whatsapp_number');
    const sameAsMobile = document.getElementById('sameAsMobile');

    // Sync WhatsApp with Mobile
    sameAsMobile.addEventListener('change', function() {
        if (this.checked) {
            whatsappNumber.value = mobileNumber.value;
            whatsappNumber.readOnly = true;
        } else {
            whatsappNumber.readOnly = false;
        }
    });

    mobileNumber.addEventListener('input', function() {
        if (sameAsMobile.checked) {
            whatsappNumber.value = this.value;
        }
    });

    // Handle State selection
    function handleStateChange() {
        const val = stateSelect.value;
        if (val === 'Tamil Nadu') {
            districtSelect.required = true;
            
            // Hide other State
            otherStateSection.classList.remove('show');
            otherStateInput.required = false;
            otherStateInput.value = '';
        } else if (val === 'Other State') {
            districtSelect.required = false;
            
            // Show other State Input
            otherStateSection.classList.add('show');
            otherStateInput.required = true;
        } else {
            districtSelect.required = false;
            
            otherStateSection.classList.remove('show');
            otherStateInput.required = false;
            otherStateInput.value = val; // Set the value to matching state
        }
    }
    
    stateSelect.addEventListener('change', handleStateChange);
    // Trigger on load for initial state setup
    handleStateChange();

    // Handle Custom District
    function handleDistrictChange() {
        if (districtSelect.value === 'Other') {
            customDistrictSection.classList.add('show');
            customDistrictInput.required = true;
            customDistrictInput.name = 'district';
            districtSelect.removeAttribute('name');
        } else {
            customDistrictSection.classList.remove('show');
            customDistrictInput.required = false;
            customDistrictInput.removeAttribute('name');
            districtSelect.name = 'district';
        }
    }
    districtSelect.addEventListener('change', handleDistrictChange);
    // Trigger on load for initial district setup
    handleDistrictChange();

    // Handle Custom Category
    function handleCategoryChange() {
        if (businessCategory.value === 'Other') {
            customCategorySection.classList.add('show');
            customCategoryInput.required = true;
            customCategoryInput.name = 'business_category';
            businessCategory.removeAttribute('name');
        } else {
            customCategorySection.classList.remove('show');
            customCategoryInput.required = false;
            customCategoryInput.removeAttribute('name');
            businessCategory.name = 'business_category';
        }
    }
    businessCategory.addEventListener('change', handleCategoryChange);
    // Trigger on load for initial category setup
    handleCategoryChange();

    // Handle Website URL Input
    function handleWebsiteChange() {
        if (hasWebsiteYes.checked) {
            websiteUrlSection.classList.add('show');
            websiteUrlInput.required = true;
        } else {
            websiteUrlSection.classList.remove('show');
            websiteUrlInput.required = false;
            websiteUrlInput.value = '';
        }
    }
    hasWebsiteYes.addEventListener('change', handleWebsiteChange);
    hasWebsiteNo.addEventListener('change', handleWebsiteChange);
    // Trigger on load for initial website setup
    handleWebsiteChange();

    // Radio button card active styling
    const radioInputs = document.querySelectorAll('.radio-card input[type="radio"]');
    radioInputs.forEach(input => {
        // Init active state if checked (old values)
        if (input.checked) {
            input.parentElement.classList.add('active');
        }
        
        input.addEventListener('change', function() {
            const groupName = this.name;
            document.querySelectorAll(`input[name="${groupName}"]`).forEach(sibling => {
                sibling.parentElement.classList.remove('active');
            });
            if (this.checked) {
                this.parentElement.classList.add('active');
            }
        });

        // Make parent card clickable
        input.parentElement.addEventListener('click', function(e) {
            if (e.target !== input) {
                input.click();
            }
        });
    });

    // Handle form submit state to prevent double sub
    const form = document.getElementById('visitorForm');
    const submitBtn = document.getElementById('submitBtn');
    form.addEventListener('submit', function(e) {
        // Validate URL if Website is YES
        if (hasWebsiteYes.checked) {
            const urlVal = websiteUrlInput.value.trim();
            const pattern = /^(https?:\/\/)?(www\.)?([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}(\/.*)?$/;
            if (!pattern.test(urlVal)) {
                e.preventDefault(); // Stop submission
                
                // Show client-side error
                const errSpan = document.getElementById('website_url_client_error');
                errSpan.style.display = 'block';
                websiteUrlInput.classList.add('is-invalid');
                websiteUrlInput.focus();
                return;
            }
        }

        submitBtn.innerHTML = 'Registering... Please Wait';
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.7';
    });

    // Hide error message when user starts typing in website URL field
    websiteUrlInput.addEventListener('input', function() {
        const errSpan = document.getElementById('website_url_client_error');
        if (errSpan) {
            errSpan.style.display = 'none';
        }
        this.classList.remove('is-invalid');
    });
});
</script>
@endsection
