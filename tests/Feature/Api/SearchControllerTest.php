<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class SearchControllerTest extends TestCase
{
    public function testGetProvince()
    {
        $province = ['id' => 1];
        $token = ['Authorization' => 'Bearer ' . JWTAuth::fromUser(User::where('email', 'admin@gmail.com')->first())];
        // dd($token);
        $this->json('GET', 'api/search/provinces', $province, $token)
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'result' => [
                    '*' => [
                        'province_id',
                        'province'
                    ],
                ]
            ]);
    }

    public function testGetCity()
    {
        $province = ['id' => 39, 'province' => 5];
        $token = ['Authorization' => 'Bearer ' . JWTAuth::fromUser(User::where('email', 'admin@gmail.com')->first())];
        // dd($token);
        $this->json('GET', 'api/search/cities', $province, $token)
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'result' => [
                    '*' => [
                        'city_id',
                        'province_id',
                        'province',
                        'type',
                        'city_name'
                    ],
                ]
            ]);
    }
}
