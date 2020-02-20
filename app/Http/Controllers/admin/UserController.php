<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function change_approve_status(User $user)
    {
        if ($user->approved)
            $user->approved = false;
        else
            $user->approved = true;

        $user->save();
        return redirect()->back();
    }

}
