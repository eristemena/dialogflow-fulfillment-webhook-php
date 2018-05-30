<?php

namespace Dialogflow\Action\Device;

use Dialogflow\Action\Device\Location\LatLang;

class Location
{
    /** @var null|string */
    protected $city;

    /** @var null|Dialogflow\Action\Device\Location\LatLang */
    protected $coordinates;

    /** @var null|string */
    protected $formattedAddress;

    /** @var null|string */
    protected $zipCode;

    /**
     * @param array $data request array
     */
    public function __construct($data)
    {
        if (isset($data['city'])) {
            $this->city = $data['city'];
        }

        if (isset($data['coordinates'])) {
            $this->coordinates = new LatLang($data['coordinates']);
        }

        if (isset($data['formattedAddress'])) {
            $this->formattedAddress = $data['formattedAddress'];
        }

        if (isset($data['zipCode'])) {
            $this->zipCode = $data['zipCode'];
        }
    }

    /**
     * City.
     * Requires the DEVICE_PRECISE_LOCATION or DEVICE_COARSE_LOCATION permission.
     *
     * @return null|string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Geo coordinates.
     * Requires the DEVICE_PRECISE_LOCATION permission.
     *
     * @return null|Dialogflow\Action\Device\Location\LatLang
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * Display address, e.g., "1600 Amphitheatre Pkwy, Mountain View, CA 94043".
     * Requires the DEVICE_PRECISE_LOCATION permission.
     *
     * @return null|string
     */
    public function getFormattedAddress()
    {
        return $this->formattedAddress;
    }

    /**
     * Zip code.
     * Requires the DEVICE_PRECISE_LOCATION or DEVICE_COARSE_LOCATION permission.
     *
     * @return null|string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }
}
