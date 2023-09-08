<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Province;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchProvinceCityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'province-city:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Province and City data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = '0df6d5bf733214af6c6644eb8717c92c';
        try {
            // $this->info('succeess');
            $this->info('Get Province ...');
            $resProv = Http::get('https://api.rajaongkir.com/starter/province', [
                'key' => $key,
            ]);

            $this->info('Get City ...');
            $resCity = Http::get('https://api.rajaongkir.com/starter/city', [
                'key' => $key,
            ]);

            if ($resProv->failed() || $resCity->failed()) {
                $this->error('Process Failed!');
            }

            if ($resProv->serverError() || $resCity->serverError()) {
                $this->error('Process Failed, Server Error!');
            }

            if ($resProv->clientError() || $resCity->clientError()) {
                $this->error('Invalid Key!');
            }

            if ($resProv->successful() && $resCity->successful()) {
                $dProv = json_decode($resProv->body());
                $rProv = $dProv->rajaongkir->results;
                $province = [];
                foreach ($rProv as $prov) {
                    $province[] = [
                        'id' => addslashes($prov->province_id),
                        'province' => addslashes($prov->province),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                $this->info('Saving Province ...');
                Province::truncate()->insert($province);

                $dCity = json_decode($resCity->body());
                $rCity = $dCity->rajaongkir->results;
                $city = [];
                foreach ($rCity as $cty) {
                    $city[] = [
                        'id' => addslashes($cty->city_id),
                        'province_id' => addslashes($cty->province_id),
                        'type' => addslashes($cty->type),
                        'city_name' => addslashes($cty->city_name),
                        'postal_code' => addslashes($cty->postal_code),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                $this->info('Saving City ...');
                City::truncate()->insert($city);
                $this->info('Success!');
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
