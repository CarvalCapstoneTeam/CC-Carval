<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Send Newsletter
     * 
     * This endpoint is used to send a newsletter.
     * 
     * @bodyParam mesage string required
     * Example: This app really helps me as a job seeker.
     */
    public function sendNewsletter(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required'
            ]);

            Newsletter::create([
                'message' => $request->message
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Newsletter sent successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
