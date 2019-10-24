<?php

namespace App\Http\Controllers;

use App\Site;
use Illuminate\Routing\Controller as BaseController;

class SiteController extends BaseController
{
    public function index()
    {
        return view('site.index', ['sites' => Site::all()]);
    }
}
