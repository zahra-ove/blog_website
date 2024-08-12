<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function include(string $relationship): bool
    {
        if(! request()->has('include')) {
            return false;
        }

        $relationships = explode(',', strtolower(request()->get('include')));
        return in_array(strtolower($relationship), $relationships);
    }
}
