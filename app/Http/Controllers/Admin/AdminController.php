<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentRack;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin-dashboard');
    }

    public function input_archive()
    {
        $raks = DocumentRack::all();
        return view('admin.archive.archive-rack', compact('raks'));
    }
}
