<?php

namespace Dialogflow\Action;

use Dialogflow\Action\Device\Location;

class Device
{
    /** @var null|Dialogflow\Action\Device\Location */
    protected $location;

    /**
     * @param array $data request array
     */
    public function __construct($data)
    {
        if (isset($data['location'])) {
            $this->location = new Location($data['location']);
        }
    }

    /**
     * If granted permission to device's location in previous intent, returns device's location.
     *
     * @return null|Dialogflow\Action\Device\Location
     */
    public function getLocation()
    {
        return $this->location;
    }
}
