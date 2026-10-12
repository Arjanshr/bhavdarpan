<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PasswordController extends Controller
{
    public function edit(): View
    {
        return view('admin.password.edit');
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'string', 'min:12', 'confirmed'],
        ]);

        $request->user()->forceFill([
            'password' => $validated['password'],
        ])->save();

        $request->session()->regenerate();

        return redirect()
            ->route('admin.password.edit')
            ->with('success', 'Your password has been changed.');
    }
}
