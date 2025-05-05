<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB; // Import the DB facade
use Closure;
use Illuminate\Http\Request;

class TrackVisits
{
    public function handle(Request $request, Closure $next)
    {
        // Get visitor information
        $visitor_ip = $request->ip();  // Get the IP address
        $visitor_id = null;  // For anonymous visitors

        // Get the current date and page URL
        $visit_date = now()->toDateString();
        $page = $request->path();  // Get the current page name

        // Insert visit data into the database
        DB::table('tblpageviews')->insert([
            'visit_date' => $visit_date,
            'visitor_ip' => $visitor_ip,
            'visitor_id' => $visitor_id,
            'page' => $page
        ]);

        return $next($request);  // Continue the request lifecycle
    }
}
