<?php

namespace App\Services;

use App\Requirement;

class RequirementService
{
    public function getUserRequirements(int $userId)
    {
        return Requirement::whereHas('project', function($query) use ($userId){
			$query->where('user_id', $userId);
		})->get();
    }
}
