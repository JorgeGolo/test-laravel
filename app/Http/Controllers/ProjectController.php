<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;

class ProjectController extends Controller
{
    public function activitiesByProjectId($id) {

        return Project::find($id)->activities;

    }

    public function usersByProjectId($id) {

        return Project::find($id)->users;

    }
}
