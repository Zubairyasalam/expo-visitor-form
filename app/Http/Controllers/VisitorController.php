<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function index()
    {
        $settings = $this->getSettings();
        return view('visitor_form', compact('settings'));
    }

    public function store(Request $request)
    {
        $settings = $this->getSettings();
        $rules = $this->getValidationRules($settings);

        $validated = $request->validate($rules, [
            'website_url.regex' => 'Give a valid URL',
            'website_url.required_if' => 'Website URL is required when website is Yes.',
        ]);

        // If not Tamil Nadu, set district to null
        if (isset($validated['state']) && $validated['state'] !== 'Tamil Nadu') {
            $validated['district'] = null;
        } else {
            $validated['other_state_name'] = null;
        }

        // If has_website is false, set website_url to null
        if (isset($validated['has_website']) && !$validated['has_website']) {
            $validated['website_url'] = null;
        }

        $validated['custom_fields'] = $request->input('custom_fields') ?? [];

        $visitor = Visitor::create($validated);

        $settings = $this->getSettings();

        return view('visitor_success', compact('visitor', 'settings'));
    }

    public function adminDashboard(Request $request)
    {
        $query = Visitor::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('mobile_number', 'like', "%{$search}%")
                  ->orWhere('business_name', 'like', "%{$search}%")
                  ->orWhere('business_category', 'like', "%{$search}%");
            });
        }

        // State filter
        if ($request->filled('state_filter')) {
            $query->where('state', $request->input('state_filter'));
        }

        // District filter
        if ($request->filled('district_filter')) {
            $query->where('district', $request->input('district_filter'));
        }

        // Date filter
        if ($request->filled('date_filter')) {
            $query->whereDate('created_at', $request->input('date_filter'));
        }

        $visitors = $query->orderBy('created_at', 'desc')->paginate(20);

        // Calculate statistics
        $stats = [
            'total' => Visitor::count(),
            'tn' => Visitor::where('state', 'Tamil Nadu')->count(),
            'other' => Visitor::where('state', '!=', 'Tamil Nadu')->count(),
            'interested' => Visitor::where('interested_in_webpage', true)->count(),
        ];

        // Last 7 days registration trend for the line chart and sparklines
        $chartData = [];
        $trends = [
            'total' => [],
            'tn' => [],
            'other' => [],
            'interested' => []
        ];

        for ($i = 6; $i >= 0; $i--) {
            $dateStr = now()->subDays($i)->format('Y-m-d');
            $count = Visitor::whereDate('created_at', $dateStr)->count();
            
            $chartData[] = [
                'label' => now()->subDays($i)->format('d M'),
                'value' => $count
            ];

            $trends['total'][] = $count;
            $trends['tn'][] = Visitor::whereDate('created_at', $dateStr)->where('state', 'Tamil Nadu')->count();
            $trends['other'][] = Visitor::whereDate('created_at', $dateStr)->where('state', '!=', 'Tamil Nadu')->count();
            $trends['interested'][] = Visitor::whereDate('created_at', $dateStr)->where('interested_in_webpage', true)->count();
        }

        // Get unique states and districts for filters
        $states = Visitor::select('state')->distinct()->pluck('state');
        $districts = Visitor::select('district')->whereNotNull('district')->distinct()->pluck('district');
        $settings = $this->getSettings();

        return view('admin_dashboard', compact('visitors', 'states', 'districts', 'stats', 'chartData', 'trends', 'settings'));
    }

    public function exportCsv()
    {
        $visitors = Visitor::all();
        $fileName = 'visitors_export_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'ID', 'Name of Visitor', 'Mobile Number', 'WhatsApp Number', 
            'State', 'District (Tamil Nadu)', 'Other State Name', 
            'Business Name', 'Business Category', 'Business Activity', 
            'Has Website', 'Interested in Webpage', 'Registration Date'
        ];

        $callback = function() use($visitors, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($visitors as $visitor) {
                fputcsv($file, [
                    $visitor->id,
                    $visitor->name,
                    $visitor->mobile_number,
                    $visitor->whatsapp_number ?? 'N/A',
                    $visitor->state,
                    $visitor->district ?? 'N/A',
                    $visitor->other_state_name ?? 'N/A',
                    $visitor->business_name,
                    $visitor->business_category,
                    $visitor->business_activity,
                    $visitor->has_website ? 'Yes' : 'No',
                    $visitor->interested_in_webpage ? 'Yes' : 'No',
                    $visitor->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function edit($id)
    {
        $visitor = Visitor::findOrFail($id);
        return response()->json($visitor);
    }

    public function update(Request $request, $id)
    {
        $visitor = Visitor::findOrFail($id);

        $settings = $this->getSettings();
        $rules = $this->getValidationRules($settings);

        $validated = $request->validate($rules, [
            'website_url.regex' => 'Give a valid URL',
            'website_url.required_if' => 'Website URL is required when website is Yes.',
        ]);

        // If not Tamil Nadu, set district to null
        if ($validated['state'] !== 'Tamil Nadu') {
            $validated['district'] = null;
        } else {
            $validated['other_state_name'] = null;
        }

        // If has_website is false, set website_url to null
        if (isset($validated['has_website']) && !$validated['has_website']) {
            $validated['website_url'] = null;
        }

        $validated['custom_fields'] = $request->input('custom_fields') ?? [];

        $visitor->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Visitor record updated successfully.');
    }

    public function destroy($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Visitor registration deleted successfully.');
    }

    public function updateSettings(Request $request)
    {
        $settings = $this->getSettings();
        
        // Dynamic update of keys sent in request
        $inputs = $request->except(['_token', 'setting_section']);
        $section = $request->input('setting_section');
        
        if ($section === 'dropdowns') {
            if (!isset($inputs['categories'])) {
                $inputs['categories'] = [];
            }
            if (!isset($inputs['districts'])) {
                $inputs['districts'] = [];
            }
            if (!isset($inputs['states'])) {
                $inputs['states'] = [];
            }
            if (!isset($inputs['submit_button_options'])) {
                $inputs['submit_button_options'] = [];
            }
        } elseif ($section === 'form') {
            if (isset($inputs['fields']) && is_array($inputs['fields'])) {
                foreach ($inputs['fields'] as $key => $field) {
                    $inputs['fields'][$key]['required'] = isset($field['required']) && ($field['required'] == '1' || $field['required'] === true);
                    $inputs['fields'][$key]['enabled'] = isset($field['enabled']) && ($field['enabled'] == '1' || $field['enabled'] === true);
                }
            }
        } elseif ($section === 'success') {
            if (isset($inputs['pass_fields']) && is_array($inputs['pass_fields'])) {
                foreach ($inputs['pass_fields'] as $key => $field) {
                    $inputs['pass_fields'][$key]['enabled'] = isset($field['enabled']) && ($field['enabled'] == '1' || $field['enabled'] === true);
                }
                
                // Set disabled ones
                $allPassFields = ['name', 'mobile_number', 'whatsapp_number', 'state', 'district', 'business_name', 'business_category', 'business_activity', 'has_website', 'website_url', 'interested_in_webpage', 'created_at'];
                foreach ($allPassFields as $key) {
                    if (!isset($inputs['pass_fields'][$key])) {
                        $inputs['pass_fields'][$key] = [
                            'label' => $settings['pass_fields'][$key]['label'] ?? ucwords(str_replace('_', ' ', $key)),
                            'enabled' => false
                        ];
                    }
                }
            }
            if (isset($inputs['success_buttons']) && is_array($inputs['success_buttons'])) {
                foreach ($inputs['success_buttons'] as $key => $btn) {
                    $inputs['success_buttons'][$key]['enabled'] = isset($btn['enabled']) && ($btn['enabled'] == '1' || $btn['enabled'] === true);
                }
                
                // Set disabled ones
                $allSuccessBtns = ['register_another', 'print', 'download'];
                foreach ($allSuccessBtns as $key) {
                    if (!isset($inputs['success_buttons'][$key])) {
                        $inputs['success_buttons'][$key] = [
                            'label' => $settings['success_buttons'][$key]['label'] ?? ucwords(str_replace('_', ' ', $key)),
                            'enabled' => false
                        ];
                    }
                }
            }
        } elseif ($section === 'footer') {
            if (!isset($inputs['footer_links'])) {
                $inputs['footer_links'] = [];
            }
            if (isset($inputs['footer_links']) && is_array($inputs['footer_links'])) {
                foreach ($inputs['footer_links'] as $key => $link) {
                    $inputs['footer_links'][$key]['enabled'] = isset($link['enabled']) && ($link['enabled'] == '1' || $link['enabled'] === true);
                }
            }
            if (!isset($inputs['footer_text_lines'])) {
                $inputs['footer_text_lines'] = [];
            }
        } else {
            // Fallback for forms without setting_section
            if ($request->hasAny(['categories', 'districts', 'states', 'submit_button_options'])) {
                if (!isset($inputs['categories'])) $inputs['categories'] = [];
                if (!isset($inputs['districts'])) $inputs['districts'] = [];
                if (!isset($inputs['states'])) $inputs['states'] = [];
                if (!isset($inputs['submit_button_options'])) $inputs['submit_button_options'] = [];
            } else {
                unset($inputs['categories']);
                unset($inputs['districts']);
                unset($inputs['states']);
                unset($inputs['submit_button_options']);
            }
            
            if ($request->has('fields')) {
                if (isset($inputs['fields']) && is_array($inputs['fields'])) {
                    foreach ($inputs['fields'] as $key => $field) {
                        $inputs['fields'][$key]['required'] = isset($field['required']) && ($field['required'] == '1' || $field['required'] === true);
                        $inputs['fields'][$key]['enabled'] = isset($field['enabled']) && ($field['enabled'] == '1' || $field['enabled'] === true);
                    }
                }
            }
            
            if ($request->has('pass_fields') || $request->has('success_buttons')) {
                if (isset($inputs['pass_fields']) && is_array($inputs['pass_fields'])) {
                    foreach ($inputs['pass_fields'] as $key => $field) {
                        $inputs['pass_fields'][$key]['enabled'] = isset($field['enabled']) && ($field['enabled'] == '1' || $field['enabled'] === true);
                    }
                }
                if (isset($inputs['success_buttons']) && is_array($inputs['success_buttons'])) {
                    foreach ($inputs['success_buttons'] as $key => $btn) {
                        $inputs['success_buttons'][$key]['enabled'] = isset($btn['enabled']) && ($btn['enabled'] == '1' || $btn['enabled'] === true);
                    }
                }
            }
            
            if ($request->has('footer_year') || $request->has('footer_copyright_text')) {
                if (!isset($inputs['footer_links'])) {
                    $inputs['footer_links'] = [];
                }
                if (isset($inputs['footer_links']) && is_array($inputs['footer_links'])) {
                    foreach ($inputs['footer_links'] as $key => $link) {
                        $inputs['footer_links'][$key]['enabled'] = isset($link['enabled']) && ($link['enabled'] == '1' || $link['enabled'] === true);
                    }
                }
                if (!isset($inputs['footer_text_lines'])) {
                    $inputs['footer_text_lines'] = [];
                }
            }
        }
        
        foreach ($inputs as $key => $value) {
            $settings[$key] = $value;
        }
        
        $this->saveSettings($settings);
        
        return redirect()->route('admin.dashboard')->with('success', 'CMS Settings updated successfully.');
    }

    private function getSettings()
    {
        $path = storage_path('app/settings.json');
        $defaultFields = [
            'name' => [
                'id' => 'name',
                'label' => 'Name of Visitor',
                'placeholder' => 'Enter your full name',
                'required' => true,
                'enabled' => true
            ],
            'mobile_number' => [
                'id' => 'mobile_number',
                'label' => 'Mobile Number',
                'placeholder' => 'Enter 10-digit mobile number',
                'required' => true,
                'enabled' => true
            ],
            'whatsapp_number' => [
                'id' => 'whatsapp_number',
                'label' => 'WhatsApp Number',
                'placeholder' => 'Enter WhatsApp number (Optional)',
                'required' => false,
                'enabled' => true
            ],
            'state' => [
                'id' => 'state',
                'label' => 'State',
                'placeholder' => 'Choose',
                'required' => true,
                'enabled' => true
            ],
            'district' => [
                'id' => 'district',
                'label' => 'Select District (Tamil Nadu)',
                'placeholder' => 'Choose',
                'required' => true,
                'enabled' => true
            ],
            'business_name' => [
                'id' => 'business_name',
                'label' => 'Business Name',
                'placeholder' => 'Enter your business/company name',
                'required' => true,
                'enabled' => true
            ],
            'business_category' => [
                'id' => 'business_category',
                'label' => 'Business Category',
                'placeholder' => 'Choose',
                'required' => true,
                'enabled' => true
            ],
            'business_activity' => [
                'id' => 'business_activity',
                'label' => 'Business Activity',
                'placeholder' => 'Enter your business activity',
                'required' => true,
                'enabled' => true
            ],
            'has_website' => [
                'id' => 'has_website',
                'label' => 'Do you have a Website?',
                'placeholder' => '',
                'required' => true,
                'enabled' => true
            ],
            'interested_in_webpage' => [
                'id' => 'interested_in_webpage',
                'label' => 'Are you interested in creating a webpage under Myindialiving.com?',
                'placeholder' => '',
                'required' => true,
                'enabled' => true
            ]
        ];

        if (!file_exists($path)) {
            if (!is_dir(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }
            $defaults = [
                'registration_title' => 'Expo Registration Form',
                'registration_subtitle' => 'Please fill in your details to register as a visitor',
                'crm_title' => 'Expo Desk CRM',
                'crm_powered_by' => 'Powered by My India Living Digital Platform',
                'crm_website' => 'https://myindialiving.com',
                'categories' => ['Real Estate', 'Engineer/Contractor', 'Maintenance Services', 'Health Care', 'Education', 'Tours and Hospitality', 'Professional Services', 'Products'],
                'districts' => ['Ariyalur', 'Chengalpattu', 'Chennai', 'Coimbatore', 'Cuddalore', 'Dharmapuri', 'Dindigul', 'Erode', 'Kallakurichi', 'Kancheepuram', 'Kanniyakumari', 'Karur', 'Krishnagiri', 'Madurai', 'Mayiladuthurai', 'Nagapattinam', 'Namakkal', 'Nilgiris', 'Perambalur', 'Pudukkottai', 'Ramanathapuram', 'Ranipet', 'Salem', 'Sivaganga', 'Tenkasi', 'Thanjavur', 'Theni', 'Thoothukudi', 'Tiruchirappalli', 'Tirunelveli', 'Tirupattur', 'Tiruppur', 'Tiruvallur', 'Tiruvannamalai', 'Tiruvarur', 'Vellore', 'Viluppuram', 'Virudhunagar'],
                'states' => ['Tamil Nadu', 'Other State'],
                'submit_button_text' => 'Submit Registration',
                'submit_button_options' => ['Submit Registration', 'Register Now', 'Register Form', 'Join Expo'],
                'success_title' => 'Registration Successful!',
                'success_subtitle' => 'Thank you for registering. Your details have been saved.',
                'pass_title' => 'Visitor Registration Pass',
                'pass_prefix' => 'MIL-EXPO-',
                'pass_fields' => [
                    'name' => ['label' => 'Visitor Name', 'enabled' => true],
                    'mobile_number' => ['label' => 'Mobile Number', 'enabled' => true],
                    'whatsapp_number' => ['label' => 'WhatsApp Number', 'enabled' => true],
                    'state' => ['label' => 'State', 'enabled' => true],
                    'district' => ['label' => 'District', 'enabled' => true],
                    'business_name' => ['label' => 'Business Name', 'enabled' => true],
                    'business_category' => ['label' => 'Business Category', 'enabled' => true],
                    'business_activity' => ['label' => 'Business Activity', 'enabled' => true],
                    'has_website' => ['label' => 'Has Website', 'enabled' => true],
                    'website_url' => ['label' => 'Website URL', 'enabled' => true],
                    'interested_in_webpage' => ['label' => 'Webpage Interest', 'enabled' => true],
                    'created_at' => ['label' => 'Date & Time', 'enabled' => true]
                ],
                'success_buttons' => [
                    'register_another' => ['label' => 'Register Another', 'enabled' => true],
                    'print' => ['label' => 'Print', 'enabled' => true],
                    'download' => ['label' => 'Download', 'enabled' => true]
                ],
                'footer_year' => '2026',
                'footer_copyright_text' => 'My India Living',
                'footer_copyright_link' => 'https://myindialiving.com',
                'footer_subtitle' => 'Expo Visitor Registration System',
                'footer_links' => [
                    ['label' => 'Privacy Policy', 'url' => 'https://myindialiving.com/privacy', 'enabled' => true],
                    ['label' => 'Terms of Use', 'url' => 'https://myindialiving.com/terms', 'enabled' => true],
                    ['label' => 'Contact Us', 'url' => 'https://myindialiving.com/contact', 'enabled' => true]
                ],
                'footer_text_lines' => [
                    ['text' => '© 2026 My India Living. All rights reserved.', 'link_url' => 'https://myindialiving.com'],
                    ['text' => 'Expo Visitor Registration System', 'link_url' => '']
                ],
                'fields' => $defaultFields
            ];
            file_put_contents($path, json_encode($defaults, JSON_PRETTY_PRINT));
            return $defaults;
        }
        
        $settings = json_decode(file_get_contents($path), true);
        if (empty($settings['categories'])) {
            $settings['categories'] = ['Real Estate', 'Engineer/Contractor', 'Maintenance Services', 'Health Care', 'Education', 'Tours and Hospitality', 'Professional Services', 'Products'];
        }
        if (empty($settings['districts'])) {
            $settings['districts'] = ['Ariyalur', 'Chengalpattu', 'Chennai', 'Coimbatore', 'Cuddalore', 'Dharmapuri', 'Dindigul', 'Erode', 'Kallakurichi', 'Kancheepuram', 'Kanniyakumari', 'Karur', 'Krishnagiri', 'Madurai', 'Mayiladuthurai', 'Nagapattinam', 'Namakkal', 'Nilgiris', 'Perambalur', 'Pudukkottai', 'Ramanathapuram', 'Ranipet', 'Salem', 'Sivaganga', 'Tenkasi', 'Thanjavur', 'Theni', 'Thoothukudi', 'Tiruchirappalli', 'Tirunelveli', 'Tirupattur', 'Tiruppur', 'Tiruvallur', 'Tiruvannamalai', 'Tiruvarur', 'Vellore', 'Viluppuram', 'Virudhunagar'];
        }
        if (!isset($settings['fields'])) {
            $settings['fields'] = $defaultFields;
        }
        if (empty($settings['states'])) {
            $settings['states'] = ['Tamil Nadu', 'Other State'];
        }
        if (!isset($settings['submit_button_text'])) {
            $settings['submit_button_text'] = 'Submit Registration';
        }
        if (empty($settings['submit_button_options'])) {
            $settings['submit_button_options'] = ['Submit Registration', 'Register Now', 'Register Form', 'Join Expo'];
        }
        if (!isset($settings['success_title'])) {
            $settings['success_title'] = 'Registration Successful!';
        }
        if (!isset($settings['success_subtitle'])) {
            $settings['success_subtitle'] = 'Thank you for registering. Your details have been saved.';
        }
        if (!isset($settings['pass_title'])) {
            $settings['pass_title'] = 'Visitor Registration Pass';
        }
        if (!isset($settings['pass_prefix'])) {
            $settings['pass_prefix'] = 'MIL-EXPO-';
        }
        if (!isset($settings['pass_fields'])) {
            $settings['pass_fields'] = [
                'name' => ['label' => 'Visitor Name', 'enabled' => true],
                'mobile_number' => ['label' => 'Mobile Number', 'enabled' => true],
                'whatsapp_number' => ['label' => 'WhatsApp Number', 'enabled' => true],
                'state' => ['label' => 'State', 'enabled' => true],
                'district' => ['label' => 'District', 'enabled' => true],
                'business_name' => ['label' => 'Business Name', 'enabled' => true],
                'business_category' => ['label' => 'Business Category', 'enabled' => true],
                'business_activity' => ['label' => 'Business Activity', 'enabled' => true],
                'has_website' => ['label' => 'Has Website', 'enabled' => true],
                'website_url' => ['label' => 'Website URL', 'enabled' => true],
                'interested_in_webpage' => ['label' => 'Webpage Interest', 'enabled' => true],
                'created_at' => ['label' => 'Date & Time', 'enabled' => true]
            ];
        }
        if (!isset($settings['success_buttons'])) {
            $settings['success_buttons'] = [
                'register_another' => ['label' => 'Register Another', 'enabled' => true],
                'print' => ['label' => 'Print', 'enabled' => true],
                'download' => ['label' => 'Download', 'enabled' => true]
            ];
        }
        if (!isset($settings['footer_year'])) {
            $settings['footer_year'] = '2026';
        }
        if (!isset($settings['footer_copyright_text'])) {
            $settings['footer_copyright_text'] = 'My India Living';
        }
        if (!isset($settings['footer_copyright_link'])) {
            $settings['footer_copyright_link'] = 'https://myindialiving.com';
        }
        if (!isset($settings['footer_subtitle'])) {
            $settings['footer_subtitle'] = 'Expo Visitor Registration System';
        }
        if (!isset($settings['footer_links'])) {
            $settings['footer_links'] = [
                ['label' => 'Privacy Policy', 'url' => 'https://myindialiving.com/privacy', 'enabled' => true],
                ['label' => 'Terms of Use', 'url' => 'https://myindialiving.com/terms', 'enabled' => true],
                ['label' => 'Contact Us', 'url' => 'https://myindialiving.com/contact', 'enabled' => true]
            ];
        }
        if (!isset($settings['footer_text_lines'])) {
            $settings['footer_text_lines'] = [
                ['text' => '© 2026 My India Living. All rights reserved.', 'link_url' => 'https://myindialiving.com'],
                ['text' => 'Expo Visitor Registration System', 'link_url' => '']
            ];
        }
        return $settings;
    }

    private function saveSettings($settings)
    {
        $path = storage_path('app/settings.json');
        file_put_contents($path, json_encode($settings, JSON_PRETTY_PRINT));
    }

    private function getValidationRules($settings)
    {
        $fields = $settings['fields'] ?? [];

        $isReq = function($key, $default = 'required') use ($fields) {
            $f = $fields[$key] ?? [];
            $enabled = $f['enabled'] ?? true;
            $required = $f['required'] ?? true;
            
            // If the field is disabled, it is not required (optional/nullable)
            if (!$enabled) {
                return 'nullable';
            }
            return $required ? $default : 'nullable';
        };

        $rules = [
            'name' => $isReq('name') . '|string|max:255',
            'mobile_number' => $isReq('mobile_number') . '|string|max:15',
            'whatsapp_number' => $isReq('whatsapp_number', 'nullable') . '|string|max:15',
            'state' => $isReq('state') . '|string|max:100',
            'district' => (($fields['district']['enabled'] ?? true) && ($fields['district']['required'] ?? true)) ? 'required_if:state,Tamil Nadu|nullable|string|max:100' : 'nullable|string|max:100',
            'other_state_name' => 'required_unless:state,Tamil Nadu|nullable|string|max:100',
            'business_name' => $isReq('business_name') . '|string|max:255',
            'business_category' => $isReq('business_category') . '|string|max:100',
            'business_activity' => $isReq('business_activity') . '|string|max:100',
            'has_website' => $isReq('has_website') . '|boolean',
            'website_url' => 'required_if:has_website,1|nullable|regex:/^(https?:\/\/)?(www\.)?([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}(\/.*)?$/|max:255',
            'interested_in_webpage' => $isReq('interested_in_webpage') . '|boolean',
        ];

        // Add rules for custom fields
        foreach ($fields as $key => $field) {
            if (!in_array($key, ['name', 'mobile_number', 'whatsapp_number', 'state', 'district', 'business_name', 'business_category', 'business_activity', 'has_website', 'interested_in_webpage'])) {
                $enabled = $field['enabled'] ?? true;
                $required = $field['required'] ?? true;
                if ($enabled) {
                    $rules["custom_fields.{$key}"] = ($required ? 'required' : 'nullable') . '|string|max:255';
                }
            }
        }

        return $rules;
    }
}
