<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    private $key = '0df6d5bf733214af6c6644eb8717c92c';
    public function provinces()
    {


        if (request('id')) {
            if (env('DATA_SOURCE') == 'api') {
                $resProv = Http::get('https://api.rajaongkir.com/starter/province', [
                    'key' => $this->key,
                    'id' => request('id'),
                ]);
                if ($resProv->successful()) {
                    $dProv = json_decode($resProv->body());
                    $rProv[] = $dProv->rajaongkir->results;
                    return response()->json([
                        'success' => true,
                        'result' => $rProv,
                    ]);
                }
            } else {
                $province = Province::select('id AS province_id', 'province')->where('id', request('id'))->get();
                return response()->json([
                    'success' => true,
                    'result' => $province,
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'ID not provided'
            ], 401);
        }
    }

    public function cities()
    {
        if (request('id') || request('province')) {

            if (env('DATA_SOURCE') == 'api') {
                $resCity = Http::get('https://api.rajaongkir.com/starter/city', [
                    'key' => $this->key,
                    'id' => request('id'),
                    'province' => request('province'),
                ]);
                if ($resCity->successful()) {
                    $dCity = json_decode($resCity->body());
                    $rCity[] = $dCity->rajaongkir->results;
                    return response()->json([
                        'success' => true,
                        'result' => $rCity
                    ]);
                }
            } else {
                $city = City::where('id', request('id'))
                    ->where('province_id', request('province'))
                    ->get();

                $data = $city->map(function ($city) {
                    return [
                        'city_id' => $city->id,
                        'province_id' => $city->province_id,
                        'province' => $city->province->province,
                        'type' => $city->type,
                        'city_name' => $city->city_name,
                        'postal_code' => $city->postal_code
                    ];
                });
                // dd($city);
                return response()->json([
                    'success' => true,
                    'result' => $data,
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'ID not provided'
            ], 401);
        }
    }
}
