<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Illuminate\Support\Facades\Http;

class ZohoController extends Controller
{
    public function createDeal(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'stage' => 'required|string',
        ]);
        $data = [
            "data" => [
                [
                    'Deal_Name' => $request['name'],
                    'Stage' => $request['stage'],
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Authorization: Zoho-oauthtoken ' . $this->generateAccessToken(),
            'Content-Type: application/x-www-form-urlencoded'
        ])
        ->post('https://zohoapis.com/crm/v2/Deals', $data);

        return $response;
    }

    public function createTask(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|string',
        ]);
        $data = [
            "data" => [
                [
                    'Subject' => $request['subject']
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Authorization: Zoho-oauthtoken ' . $this->generateAccessToken(),
            'Content-Type: application/x-www-form-urlencoded'
        ])
        ->post('https://zohoapis.com/crm/v2/Tasks', $data);

        return $response;
    }

    private function generateAccessToken()
    {
        $post = [
            'refresh_token' => '1000.a8bc6e2f84d6c7aaf95c253104b4b499.d7493a019c1261db04cbf91b17ed206d',
            'redirect_uri' => 'https://google.com',
            'client_id' => '1000.A9QLX5MYVZ0HG2YVH1Q3ZYHXNZC25B',
            'client_secret' => '8172d7664de0ff2572d8d2048005c4837e2c1a2ce9',
            'grant_type' => 'refresh_token'
        ];

        $response = Http::asForm()
        ->post('https://accounts.zoho.com/oauth/v2/token',
           $post
        );

        return json_decode($response, true)['access_token'];
    }
}