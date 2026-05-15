<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Event;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $news_count = News::count();
        $events_count = Event::count();
        $admins_count = User::where('role', 'admin')->count();
        $users_count = User::where('role', 'user')->count();
        return view('admin.dashboard', compact('news_count', 'events_count', 'admins_count', 'users_count'));
    }
    public function getAjaxList(Request $request)
    {
        $items = array();
        $value = $request->q;

        switch ($request->type) {

            case 'admins':
                $items = User::where('role', 'admin')
                    ->where('status', 1)
                    ->selectRaw("id, CONCAT(name, CASE WHEN national_id IS NOT NULL AND national_id != '' THEN CONCAT(' - ', national_id) ELSE '' END) as text");

                if ($value != '') {
                    $items->where(function ($query) use ($value) {
                        $query->where('name', 'LIKE', '%' . $value . '%')
                            ->orWhere('national_id', 'LIKE', '%' . $value . '%');
                    });
                }

                $items = $items->get();

                break;

            case 'users':
                $items = User::where('role', 'user')
                    ->where('status', 1)
                    ->selectRaw("id, CONCAT(name, CASE WHEN national_id IS NOT NULL AND national_id != '' THEN CONCAT(' - ', national_id) ELSE '' END) as text");

                if ($value != '') {
                    $items->where(function ($query) use ($value) {
                        $query->where('name', 'LIKE', '%' . $value . '%')
                            ->orWhere('national_id', 'LIKE', '%' . $value . '%')
                            ->orWhereHas('member', function ($memberQuery) use ($value) {
                                $memberQuery->where('national_id', 'LIKE', '%' . $value . '%');
                            });
                    });
                }

                $items = $items->get();
                break;
            default:
                break;
        }
        return response()->json(['status' => 'true', 'results' => $items]);
    }
    public function appSettings()
    {
        $settings = AppSetting::pluck('value', 'key');

        $banner_image   = $settings['banner_image'] ?? null;
        $show_elections = isset($settings['show_elections']) ? (bool) $settings['show_elections'] : false;

        $breadcrumbs = [
            ['name' => __('messages.app_settings'), 'url' => route('admin.appSettings.index')],
        ];

        return view('admin.app-settings.index', compact(
            'banner_image',
            'show_elections',
            'breadcrumbs'
        ));
    }

    public function updateAppSettings(Request $request)
    {
        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'show_elections' => 'required|boolean',
        ]);

        // Update show_elections
        AppSetting::updateOrCreate(
            ['key' => 'show_elections'],
            ['value' => $request->show_elections]
        );

        // Update banner_image if provided
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('uploads/settings', 'public');
            AppSetting::updateOrCreate(
                ['key' => 'banner_image'],
                ['value' => 'storage/' . $path]
            );
        }

        return redirect()->route('admin.appSettings.index')->with('success', __('messages.settings_updated'));
    }


}
