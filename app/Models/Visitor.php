<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'name',
        'mobile_number',
        'whatsapp_number',
        'state',
        'district',
        'other_state_name',
        'business_name',
        'business_category',
        'business_activity',
        'has_website',
        'website_url',
        'interested_in_webpage',
        'custom_fields',
    ];

    protected $casts = [
        'has_website' => 'boolean',
        'interested_in_webpage' => 'boolean',
        'custom_fields' => 'array',
    ];
}
