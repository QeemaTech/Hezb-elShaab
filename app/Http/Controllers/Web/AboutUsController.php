<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\AboutUsRequest;
use App\Models\AppSetting;
use App\Models\AboutUsFaq;
use Illuminate\Support\Facades\DB;

class AboutUsController extends Controller
{
    public function index()
    {
        $settings = AppSetting::pluck('value', 'key');

        $visionText = $settings['about_us_vision'] ?? '';
        $contactEmail = $settings['about_us_contact_email'] ?? '';
        $membershipFormUrl = $settings['about_us_membership_form_url'] ?? '';
        $faqs = AboutUsFaq::orderBy('sort_order')->orderBy('id')->get(['question', 'answer'])->toArray();

        $breadcrumbs = [
            ['name' => __('messages.about_us'), 'url' => route('admin.aboutUs.index')],
        ];

        return view('admin.about-us.index', compact(
            'visionText',
            'contactEmail',
            'membershipFormUrl',
            'faqs',
            'breadcrumbs'
        ));
    }

    public function update(AboutUsRequest $request)
    {
        $validated = $request->validated();

        $faqs = collect($validated['faqs'] ?? [])
            ->filter(function ($faq) {
                return !empty(trim($faq['question'] ?? '')) || !empty(trim($faq['answer'] ?? ''));
            })
            ->map(function ($faq) {
                return [
                    'question' => trim($faq['question']),
                    'answer' => trim($faq['answer']),
                ];
            })
            ->values()
            ->all();

        DB::transaction(function () use ($validated, $faqs) {
            AppSetting::updateOrCreate(['key' => 'about_us_vision'], ['value' => $validated['vision_text']]);
            AppSetting::updateOrCreate(['key' => 'about_us_contact_email'], ['value' => $validated['contact_email']]);
            AppSetting::updateOrCreate(['key' => 'about_us_membership_form_url'], ['value' => $validated['membership_form_url']]);

            AboutUsFaq::query()->delete();
            foreach ($faqs as $index => $faq) {
                AboutUsFaq::create([
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                    'sort_order' => $index + 1,
                ]);
            }
        });

        return redirect()->route('admin.aboutUs.index')->with('success', __('messages.settings_updated'));
    }
}
