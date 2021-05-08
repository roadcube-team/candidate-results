<?php

namespace App\Traits;

use App\Models\Log;
use Illuminate\Http\Request;

trait Logger
{

    /**
     * @param Request $request
     *
     * @return void 
     *
     * Save a request to the log for statistics
     * 
     */
    public function logRequest(Request $request)
    {
        Log::create([
            'ip' => $request->ip(),
            'endpoint' => $request->getRequestUri()
        ]);
    }
}
