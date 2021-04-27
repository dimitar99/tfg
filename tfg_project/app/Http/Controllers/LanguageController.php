<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        if (in_array($lang, ['es', 'en'])) {
            App::setLocale('en');
        }
        return redirect()->route('users.list');
    }
}
