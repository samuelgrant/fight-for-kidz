<?php

namespace App\Http\Controllers\admin;

use App\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetaSettingsController extends Controller
{
    public function get() {
        return response()->json(SiteSetting::getSiteMeta());
    }

    public function update(Request $request) {
        $this->validate($request, [
            'seo_author' => 'string|max:255',
            'seo_description' => 'string|max:512',
            'seo_keywords' => 'string|max:255',
            'seo_theme_color' => 'string|max:7',
        ]);

        $settings = SiteSetting::getSettings();

        $settings->seo_author = $request->input('seo_author');
        $settings->seo_description = $request->input('seo_description');
        $settings->seo_keywords = $request->input('seo_keywords');
        $settings->seo_theme_color = $request->input('seo_theme_color');
        $settings->save();

        return response('Metadata settings updated successfully', 200);
    }
}
