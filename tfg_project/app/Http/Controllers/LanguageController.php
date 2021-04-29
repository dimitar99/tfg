<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        $cookie = cookie('language', 'es', 10080);

        if (in_array($lang, ['es', 'en'])) {
            $cookie = cookie('language', $lang, 10080);
        }

        return redirect()->back()->withCookie($cookie);
    }
}
