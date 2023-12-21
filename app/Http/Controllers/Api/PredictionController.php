<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PredictionController extends Controller
{
    /**
     * Predict a Job Vacancy
     * 
     * This endpoint is used to predict the authenticity of job vacancies.
     * 
     * @authenticated
     * 
     * @bodyParam title string required
     * Example: Junior Web Developer
     * 
     * @bodyParam location string required
     * Example: Jakarta, Indonesia
     * 
     * @bodyParam department string required
     * Example: Information Technology
     * 
     * @bodyParam salary_range string required
     * Example: 70000-80000
     * 
     * @bodyParam company_profile string required
     * Example: Sigma is a leading fashion company that designs, manufactures, and distributes clothing and accessories for men, women, and children. The company was founded in 1990 and is headquartered in Jakarta, Indonesia. Sigma has a network of over 1,000 stores in Indonesia and over 50 countries worldwide.
     * 
     * @bodyParam description string required
     * Example: Sigma is looking for a talented and motivated Junior Web Developer to join our team. The ideal candidate will have a strong understanding of web development fundamentals, including HTML, CSS, and JavaScript. They should also be proficient in using popular web development frameworks and tools.
     * 
     * @bodyParam benefits string required
     * Example: Joining Sigma as a Junior Web Developer isn't just about writing code - it's about unleashing your potential. Dive into cutting-edge projects, master industry-leading frameworks, and collaborate with brilliant minds. Fuel your fashion passion alongside a supportive team, all while enjoying competitive perks, a dynamic environment, and the chance to leave your mark on a global brand. It's not just a job, it's your runway to success!
     * 
     * @bodyParam telecommuting enum(0/1) required
     * Example: 1
     */
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
