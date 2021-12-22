<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pages extends Controller
{
    /**
     * Страница примера использования формы
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function example(Request $request)
    {
        if (!env("EXAMPLE_PAGE_ACCESS", false))
            return abort(404);

        return view("example");
    }
}
