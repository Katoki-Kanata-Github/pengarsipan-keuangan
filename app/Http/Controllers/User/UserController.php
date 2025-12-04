<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.user-dashboard');
    }

    // public function pengajuan()
    // {
    //     return view('user.pengajuan.pengajuan');
    // }

    public function worklist()
    {
        $my_pengajuan = Pengajuan::with('user')->where('user_id', Auth::id())->get();
        return view('user.worklist.worklist', compact('my_pengajuan'));
    }
}
