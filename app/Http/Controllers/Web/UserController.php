<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class UserController extends Controller
{
    public function users()
    {
        $users = User::IsNotadmin()->paginate(10);

        // dd($users);

        return view('admin.users.index', compact('users'));
    }
}
