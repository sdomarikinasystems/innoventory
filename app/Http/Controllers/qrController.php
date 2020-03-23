<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Contracts\Cache\Repository;
use DateTime;
use DatePeriod;
use DateInterval;
Use Alert;

class qrController extends Controller
{
    //
    public function get_items(Request $request) {
    	$property_number=request("p_number");
    	$client= new \GuzzleHttp\Client();
        $url = WEBSERVICE_QR;
        $response = $client->request('POST', $url, [
            'form_params'=>[
                'tag' => 'select_asset_items_x',
                'property_no' => $property_number
            ]
        ]);
        $data=$response->getBody()->getContents();
        return $data;
    }
    public function print_asset(){
        $sch_id = session('user_schoolname');
    	return view('asset_printpage', ['sch_id'=>$sch_id]);
    }
    public function get_asset_items() {
    	$school_id=session("user_school");
    	$client= new \GuzzleHttp\Client();
        $url = WEBSERVICE_QR;
        $response = $client->request('POST', $url, [
            'form_params'=>[
                'tag' => 'select_asset_items',
                'sch_id' => $school_id
            ]
        ]);
        $data= json_decode($response->getBody()->getContents(), true);
        return view('asset_utilities', ['key'=>$data]);
    }
}
