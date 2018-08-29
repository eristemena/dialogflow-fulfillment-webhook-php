<?php

namespace Dialogflow\Action\Types;

class LatLng
{
    /** @var null|number */
    protected $latitude;

    /** @var null|number */
    protected $longitude;

    /**
     * @param array $data request array
     */
    public function __construct($data)
    {
        if (isset($data['latitude'])) {
            $this->latitude = $data['latitude'];
        }

        if (isset($data['longitude'])) {
            $this->longitude = $data['longitude'];
        }
    }

    /**
     * The latitude in degrees. It must be in the range [-90.0, +90.0].
     *
     * @return null|number
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * The longitude in degrees. It must be in the range [-180.0, +180.0].
     *
     * @return null|number
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
}
