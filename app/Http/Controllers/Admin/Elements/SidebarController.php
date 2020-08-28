<?php

namespace App\Http\Controllers\Admin\Elements;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SidebarController extends Controller
{
    public function show()
    {
        return view('admin.elements.sidebar');
    }
}
