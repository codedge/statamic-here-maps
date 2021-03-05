<?php

declare(strict_types=1);

namespace Codedge\HereMaps\Tags;

use Statamic\Tags\Tags;

class HereMap extends Tags
{
    const DEFAULT_ZOOM = 13;

    private ?string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('statamic-here-maps.api_key');
    }

    /**
     * {{ here_map lat="" lon="" zoom="" }}
     */
    public function index()
    {
        $lat = $this->params->float('lat');
        $lon = $this->params->float('lon');
        $zoom = $this->params->int('zoom', self::DEFAULT_ZOOM);
        $containerId =  $this->params->get('container', 'map');
        $marker = $this->params->bool('marker', false);

        return view('hmaps::partials/map-lat-lon', [
            'apiKey' => $this->apiKey,
            'scripts' => $this->scripts(),
            'container' => $containerId,
            'lat' => $lat,
            'lon' => $lon,
            'zoom' => $zoom,
            'marker' => $marker,
        ]);
    }

    /**
     * {{ here_map:address street="" zipcode="" city="" }}
     *
     */
    public function address()
    {
        $street = $this->params->get('street', '');
        $zipcode = $this->params->get('zipcode', '');
        $city = $this->params->get('city', '');
        $zoom = $this->params->int('zoom', self::DEFAULT_ZOOM);
        $containerId =  $this->params->get('container', 'map');
        $marker = $this->params->bool('marker', false);

        $address = "{$street}, {$zipcode} $city";

        return view('hmaps::partials/map-address', [
            'apiKey' => $this->apiKey,
            'scripts' => $this->scripts(),
            'container' => $containerId,
            'address' => $address,
            'zoom' => $zoom,
            'marker' => $marker,
        ]);
    }

    protected function scripts(): string
    {
        $scripts = '';

        foreach (config('statamic-here-maps.here-js-scripts') as $script) {
            $scripts .= '<script src="'.$script.'" type="text/javascript" charset="utf-8"></script>';
        }

        return $scripts;
    }

}
