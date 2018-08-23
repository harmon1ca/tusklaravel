<?php

namespace Tests\Feature;

use App\Proxies;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{

    public function testProxyCreatedCorectly()
    {
        $proxy = $this->proxy;
        $proxy->create();
        $payload = [
            'ip' => '8.8.8.8',
            'port' => '6616',
            'ssl' => '0',
            'country' => 'Poland',
            'anonymity' => '0'
        ];
        $this->json('POST','/api/proxy', $payload)
            ->assertStatus(200)
            ->assertJson([ 'ip' => '8.8.8.8', 'port' => 'Ipsum','ssl' => '0','country' => 'Poland','anonymity' => '0']);

    }
}
