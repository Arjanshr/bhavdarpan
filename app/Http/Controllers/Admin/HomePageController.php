<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use App\Services\HomePageContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class HomePageController extends Controller
{
    public function edit(HomePageContent $homePageContent): View
    {
        return view('admin.home-page.edit', [
            'content' => $homePageContent->get(),
            'fields' => $homePageContent->fields(),
        ]);
    }

    public function update(
        Request $request,
        HomePageContent $homePageContent,
    ): RedirectResponse {
        $rules = ['content' => ['required', 'array']];

        foreach ($homePageContent->fields() as $key => $field) {
            $rules["content.{$key}"] = [
                'required',
                'string',
                'max:'.($field['type'] === 'text' ? 255 : 10000),
            ];
        }

        $validated = $request->validate($rules);
        $submittedContent = array_intersect_key($validated['content'], $homePageContent->fields());
        $content = $homePageContent->sanitize($submittedContent);
        $errors = [];

        foreach ($homePageContent->fields() as $key => $field) {
            if ($field['type'] === 'rich' && trim(strip_tags($content[$key])) === '') {
                $errors["content.{$key}"] = 'This field must contain some text.';
            }
        }

        if ($errors !== []) {
            throw ValidationException::withMessages($errors);
        }

        SiteContent::query()->updateOrCreate(
            ['key' => 'home_page'],
            ['content' => $content],
        );

        return redirect()->route('admin.home-page.edit')->with('success', 'Homepage content updated.');
    }
}
