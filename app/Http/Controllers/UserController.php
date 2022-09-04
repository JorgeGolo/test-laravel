<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function issuesByUserId($id) {

        return User::find($id)->issues;

    }
}
