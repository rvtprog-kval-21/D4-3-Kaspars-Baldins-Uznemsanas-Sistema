<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\BranchResource;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends BaseController
{
    public function index() {
        return $this->sendResponse(BranchResource::collection(Branch::all()), 'Return all branches');
    }
}
