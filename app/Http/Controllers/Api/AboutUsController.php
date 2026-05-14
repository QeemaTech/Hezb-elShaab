<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\AboutUsFaq;

class AboutUsController extends Controller
{
    public function vision()
    {
        $settings = AppSetting::pluck('value', 'key');
        return response()->json([
            'about_us_vision' => $settings['about_us_vision'] ?? '',
        ]);
    }

    public function faqs()
    {
        return response()->json([
            'faqs' => AboutUsFaq::orderBy('sort_order')->orderBy('id')->get(['id', 'question', 'answer']),
        ]);
    }

    public function contactMail()
    {
        $settings = AppSetting::pluck('value', 'key');
        return response()->json([
            'contact_mail' => $settings['about_us_contact_email'] ?? '',
        ]);
    }

    public function membershipFormUrl()
    {
        $settings = AppSetting::pluck('value', 'key');
        return response()->json([
            'membership_form_url' => $settings['about_us_membership_form_url'] ?? '',
        ]);
    }
}
