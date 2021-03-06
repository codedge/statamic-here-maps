<?php

declare(strict_types=1);

namespace Codedge\HereMaps\Tests\Tags;

use Codedge\HereMaps\Tags\HereMap;
use Codedge\HereMaps\Tests\TestCase;

class HereMapTest extends TestCase
{
    protected HereMap $tag;

    public function setUp(): void
    {
        parent::setUp();
        $this->tag = new HereMap();
        $this->tag->setContext('here-map');
    }

    /** @test */
    public function it_can_be_instantiated(): void
    {
        $this->assertTrue(isset(app()['statamic.tags']['here_map']));
    }

    /** @test */
    public function it_can_create_map_based_on_lat_lon(): void
    {
        $lat = 52.520008;
        $lon = 13.404954;

        $payload = [
            'lat' => $lat,
            'lon' => $lon,
        ];
        $this->tag->setParameters($payload);

        $this->assertStringContainsString("lat: {$lat}", (string) $this->tag->index());
        $this->assertStringContainsString("lng: {$lon}", (string) $this->tag->index());
        $this->assertStringContainsString("zoom: 13", (string) $this->tag->index());
        $this->assertStringContainsString("getElementById('map')", (string) $this->tag->index());

        $payload['container'] = 'my-map';
        $this->tag->setParameters($payload);
        $this->assertStringContainsString("getElementById('my-map')", (string) $this->tag->index());
    }

    /** @test */
    public function it_can_create_map_based_on_address(): void
    {
        $street = "";
        $zipcode = "";
        $city = "";

        $address = "{$street}, {$zipcode} {$city}";

        $payload = [
            'street' => $street,
            'zipcode' => $zipcode,
            'city' => $city,
        ];
        $this->tag->setParameters($payload);

        $this->assertStringContainsString($address, (string) $this->tag->address());
        $this->assertStringContainsString("zoom: 13", (string) $this->tag->address());
        $this->assertStringContainsString("getElementById('map')", (string) $this->tag->address());

        $payload['container'] = 'my-map';
        $this->tag->setParameters($payload);
        $this->assertStringContainsString("getElementById('my-map')", (string) $this->tag->address());
    }
}
