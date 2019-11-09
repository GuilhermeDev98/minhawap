<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class FreenonController extends Controller
{
    public function searchdomain(Request $request){
        $response = $this->client()->request('get','domain/search', [
            'query' => [
                'domainname' => $request->domain,
                'email' => 'guilhermedev@hotmail.com',
                'password' => 'locilocilogunede1998',
                'domaintype' => 'paid'
            ]
        ]);

        $body = json_decode($response->getBody(), true);

        if($body['result'] == 'DOMAIN AVAILABLE'){
            $data = [
                'available' => true,
                'domain' => strtolower($body['domain'][0]['domainname']),
                'prices' => [
                    '1Y' => [
                        'usd' => $body['domain'][0]['pricing'][0]['retailprice'],
                        'brl' => ''
                    ],
                    '2Y' => [
                        'usd' => $body['domain'][0]['pricing'][1]['retailprice'],
                        'brl' => ''
                    ],
                ]
            ];
        }else{
            $data = [
                'available' => false
            ];
        }

        return response()->json($data);
    }

    public function client(){
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.freenom.com/v2/',
            ''
        ]);

        return $client;
    }
}
