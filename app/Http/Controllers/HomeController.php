<?php

namespace App\Http\Controllers;

use App\Services\HomePageContent;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(HomePageContent $homePageContent): View
    {
        return view('home', ['content' => $homePageContent->get()]);
    }
}
