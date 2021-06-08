<?php

namespace App\Traits;

use App\Models\Project;

trait ProjectTrait
{
    public function showProjects()
    {
        $projects = Project::orderBy('project')->get();
        return $projects;
    }
}
