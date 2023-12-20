<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PredictionController extends Controller
{
    public function predict(Request $request)
    {
        $url = 'https://predict-lhp755lcvq-uc.a.run.app/predict';

        $data = [
            'title' => $request->title,
            'location' => $request->location,
            'department' => $request->department,
            'salary_range' => $request->salary_range,
            'company_profile' => $request->company_profile,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'telecommuting' => $request->telecommuting
        ];

        try {
            $client = new Client();

            $response = $client->post($url, [
                'json' => $data,
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            $res = json_decode($body);

            if ($res->error == false) {
                return response()->json([
                    'error' => false,
                    'message' => $res->message,
                    'predictionResult' => $res->predictionResult
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => $res->message
                ], $statusCode);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' =>  $e->getMessage(),
            ], 500);
        }
    }
}
