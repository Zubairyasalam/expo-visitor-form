@extends('layouts.app')

@section('title', 'Registration Successful - My India Living')

@section('content')
<div class="container">
    <div class="card success-card">
        <!-- SVG Checkmark Animation -->
        <div class="checkmark-circle">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <path class="checkmark_check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>
        </div>

        <h1 class="card-title" style="color: var(--primary-green);">{{ $settings['success_title'] ?? 'Registration Successful!' }}</h1>
        <p class="card-subtitle">{{ $settings['success_subtitle'] ?? 'Thank you for registering. Your details have been saved.' }}</p>

        <!-- Receipt Layout -->
        <div class="receipt-box">
            <div style="text-align: center; border-bottom: 2px dashed var(--border-color); padding-bottom: 1rem; margin-bottom: 1rem;">
                <img src="{{ asset('mil-logo-with-tagline-bg.jpg') }}?v={{ time() }}" alt="My India Living Logo" style="height: 50px; width: auto; margin-bottom: 0.8rem; display: inline-block;">
                <p style="font-weight: 700; font-size: 1.1rem; color: var(--primary-blue); text-transform: uppercase; letter-spacing: 0.5px;">{{ $settings['pass_title'] ?? 'Visitor Registration Pass' }}</p>
                <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem;">ID: {{ $settings['pass_prefix'] ?? 'MIL-EXPO-' }}{{ str_pad($visitor->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>

            @php
                $passFields = $settings['pass_fields'] ?? [];
            @endphp

            {{-- Visitor Name --}}
            @if(($passFields['name']['enabled'] ?? true))
            <div class="receipt-row">
                <span class="receipt-label">{{ $passFields['name']['label'] ?? 'Visitor Name' }}</span>
                <span class="receipt-val">{{ $visitor->name }}</span>
            </div>
            @endif

            {{-- Mobile Number --}}
            @if(($passFields['mobile_number']['enabled'] ?? true))
            <div class="receipt-row">
                <span class="receipt-label">{{ $passFields['mobile_number']['label'] ?? 'Mobile Number' }}</span>
                <span class="receipt-val">{{ $visitor->mobile_number }}</span>
            </div>
            @endif

            {{-- WhatsApp Number --}}
            @if(($passFields['whatsapp_number']['enabled'] ?? true) && $visitor->whatsapp_number)
            <div class="receipt-row">
                <span class="receipt-label">{{ $passFields['whatsapp_number']['label'] ?? 'WhatsApp Number' }}</span>
                <span class="receipt-val">{{ $visitor->whatsapp_number }}</span>
            </div>
            @endif

            {{-- State --}}
            @if(($passFields['state']['enabled'] ?? true))
            <div class="receipt-row">
                <span class="receipt-label">{{ $passFields['state']['label'] ?? 'State' }}</span>
                <span class="receipt-val">{{ $visitor->state }}</span>
            </div>
            @endif

            {{-- District --}}
            @if(($passFields['district']['enabled'] ?? true) && $visitor->district)
            <div class="receipt-row">
                <span class="receipt-label">{{ $passFields['district']['label'] ?? 'District' }}</span>
                <span class="receipt-val">{{ $visitor->district }}</span>
            </div>
            @endif

            {{-- Other State Name --}}
            @if($visitor->other_state_name)
            <div class="receipt-row">
                <span class="receipt-label">State Name (Other)</span>
                <span class="receipt-val">{{ $visitor->other_state_name }}</span>
            </div>
            @endif

            {{-- Business Name --}}
            @if(($passFields['business_name']['enabled'] ?? true))
            <div class="receipt-row">
                <span class="receipt-label">{{ $passFields['business_name']['label'] ?? 'Business Name' }}</span>
                <span class="receipt-val">{{ $visitor->business_name }}</span>
            </div>
            @endif

            {{-- Business Category --}}
            @if(($passFields['business_category']['enabled'] ?? true))
            <div class="receipt-row">
                <span class="receipt-label">{{ $passFields['business_category']['label'] ?? 'Business Category' }}</span>
                <span class="receipt-val">{{ $visitor->business_category }}</span>
            </div>
            @endif

            {{-- Business Activity --}}
            @if(($passFields['business_activity']['enabled'] ?? true))
            <div class="receipt-row">
                <span class="receipt-label">{{ $passFields['business_activity']['label'] ?? 'Business Activity' }}</span>
                <span class="receipt-val">{{ $visitor->business_activity }}</span>
            </div>
            @endif

            {{-- Has Website --}}
            @if(($passFields['has_website']['enabled'] ?? true))
            <div class="receipt-row">
                <span class="receipt-label">{{ $passFields['has_website']['label'] ?? 'Has Website' }}</span>
                <span class="receipt-val">{{ $visitor->has_website ? 'Yes' : 'No' }}</span>
            </div>
            @endif

            {{-- Website URL --}}
            @if(($passFields['website_url']['enabled'] ?? true) && $visitor->has_website && $visitor->website_url)
            <div class="receipt-row">
                <span class="receipt-label">{{ $passFields['website_url']['label'] ?? 'Website URL' }}</span>
                <span class="receipt-val" style="word-break: break-all; max-width: 200px;">{{ $visitor->website_url }}</span>
            </div>
            @endif

            {{-- Interested in Webpage --}}
            @if(($passFields['interested_in_webpage']['enabled'] ?? true))
            <div class="receipt-row">
                <span class="receipt-label">{{ $passFields['interested_in_webpage']['label'] ?? 'Webpage Interest' }}</span>
                <span class="receipt-val">{{ $visitor->interested_in_webpage ? 'Yes' : 'No' }}</span>
            </div>
            @endif

            {{-- Custom dynamic fields on pass --}}
            @if($visitor->custom_fields && is_array($visitor->custom_fields))
                @foreach($visitor->custom_fields as $customKey => $customVal)
                    @if(!empty($customVal))
                        @php
                            $fieldConfig = $settings['fields'][$customKey] ?? null;
                            $customLabel = $fieldConfig['label'] ?? ucwords(str_replace('_', ' ', $customKey));
                        @endphp
                        <div class="receipt-row">
                            <span class="receipt-label">{{ $customLabel }}</span>
                            <span class="receipt-val">{{ $customVal }}</span>
                        </div>
                    @endif
                @endforeach
            @endif

            {{-- Date & Time --}}
            @if(($passFields['created_at']['enabled'] ?? true))
            <div class="receipt-row" style="border-top: 1px solid var(--border-color); margin-top: 0.5rem; padding-top: 0.8rem;">
                <span class="receipt-label" style="font-weight: bold;">{{ $passFields['created_at']['label'] ?? 'Date & Time' }}</span>
                <span class="receipt-val" style="font-weight: bold; color: var(--text-secondary);">{{ $visitor->created_at->format('d M Y, h:i A') }}</span>
            </div>
            @endif
        </div>

        @php
            $successButtons = $settings['success_buttons'] ?? [];
            $showRegisterAnother = $successButtons['register_another']['enabled'] ?? true;
            $showPrint          = $successButtons['print']['enabled'] ?? true;
            $showDownload       = $successButtons['download']['enabled'] ?? true;
            $registerAnotherLabel = $successButtons['register_another']['label'] ?? 'Register Another';
            $printLabel           = $successButtons['print']['label'] ?? 'Print';
            $downloadLabel        = $successButtons['download']['label'] ?? 'Download';
        @endphp

        @if($showRegisterAnother || $showPrint || $showDownload)
        <div class="no-print" style="display: flex; gap: 1rem; justify-content: center; margin-top: 1.5rem; flex-wrap: wrap;">
            @if($showRegisterAnother)
            <a href="{{ route('visitor.index') }}" class="btn-submit" style="margin-top: 0; display: inline-block; width: auto; padding: 0.8rem 1.8rem; text-decoration: none; font-family: 'Poppins', sans-serif;">{{ $registerAnotherLabel }}</a>
            @endif

            @if($showPrint)
            <button onclick="window.print()" class="btn-secondary" style="display: inline-flex; align-items: center; gap: 8px; padding: 0.8rem 1.8rem; background-color: var(--primary-blue); color: white; border: none; cursor: pointer; font-size: 1rem; font-weight: 600; box-shadow: var(--shadow-sm); border-radius: var(--radius-sm); font-family: 'Poppins', sans-serif; transition: var(--transition);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px;"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                {{ $printLabel }}
            </button>
            @endif

            @if($showDownload)
            <button id="btnDownload" onclick="downloadPass()" class="btn-secondary" style="display: inline-flex; align-items: center; gap: 8px; padding: 0.8rem 1.8rem; background-color: var(--primary-orange); color: white; border: none; cursor: pointer; font-size: 1rem; font-weight: 600; box-shadow: var(--shadow-sm); border-radius: var(--radius-sm); font-family: 'Poppins', sans-serif; transition: var(--transition);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                {{ $downloadLabel }}
            </button>
            @endif
        </div>
        @endif

        <style>
        @media print {
            body, html, main {
                background: white !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            header, footer, .checkmark-circle, .card-title, .card-subtitle, .no-print {
                display: none !important;
            }
            .container {
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .card {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                margin: 0 !important;
                background: transparent !important;
            }
            .receipt-box {
                border: 2px dashed #000 !important;
                box-shadow: none !important;
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 auto !important;
                padding: 1.5rem !important;
                page-break-inside: avoid;
            }
        }
        </style>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
function downloadPass() {
    const btn = document.getElementById('btnDownload');
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = 'Generating...';

    const element = document.querySelector('.receipt-box');
    
    html2canvas(element, {
        scale: 3,
        useCORS: true,
        backgroundColor: '#ffffff',
        logging: false
    }).then(canvas => {
        btn.disabled = false;
        btn.innerHTML = originalText;

        const link = document.createElement('a');
        link.download = 'visitor_pass_{{ $settings['pass_prefix'] ?? 'MIL-EXPO-' }}{{ str_pad($visitor->id, 5, "0", STR_PAD_LEFT) }}.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
    }).catch(err => {
        btn.disabled = false;
        btn.innerHTML = originalText;
        console.error('Error generating card download:', err);
        alert('Could not download image. Please try the Print Pass option.');
    });
}
</script>
@endsection
