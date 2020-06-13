<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CallApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePageStatus()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testGetAllRatesFromExternalApi()
    {
        $response = $this->json('GET', '/rates/gbp');
        // $response->dump($response[0]);
        $response->assertJsonStructure([[
            "title",
            "link",
            "description",
            "pubDate",
            "baseCurrency",
            "baseName",
            "targetCurrency",
            "targetName",
            "exchangeRate",
            "inverseRate",
            "inverseDescription",
        ]]);
    }
}
