<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $branch_id = null;

    public function getBranchId()
    {
        if(auth()->user()->branch_id)
        {
            $this->branch_id = auth()->user()->branch_id;
        }
        if(getSessionBranch())
        {
            $this->branch_id = getSessionBranch();
        }

        return $this->branch_id;
    }
}
