<?php

namespace Dialogflow\Action;

use Carbon\Carbon;
use Dialogflow\Action\Types\Location;

class Arguments
{
    /** @var array */
    protected $arguments = [];

    protected $mapArgumentName = [
        'CONFIRMATION' => 'getConfirmation',
        'PERMISSION'   => 'getPermission',
        'OPTION'       => 'getOption',
        'DATETIME'     => 'getDateTime',
        'PLACE'        => 'getPlace',
    ];

    /**
     * @param array $data request array
     */
    public function __construct($data)
    {
        $arguments = [];
        foreach ($data as $argumentData) {
            $arguments[] = $argumentData;
        }

        $this->arguments = $arguments;
    }

    /**
     * Get argument by name.
     *
     * @param string $name
     *
     * @return null|array|bool
     */
    public function get($name)
    {
        foreach ($this->arguments as $argument) {
            if ($argument['name'] == $name) {
                if (isset($this->mapArgumentName[$name])) {
                    return $this->{$this->mapArgumentName[$name]}($argument);
                } else {
                    return $argument;
                }
            }
        }
    }

    /**
     * Get confirmation argument.
     *
     * @param array $argument
     *
     * @return bool
     */
    private function getConfirmation($argument)
    {
        return $argument['boolValue'];
    }

    /**
     * Get permission argument.
     *
     * @param array $argument
     *
     * @return bool
     */
    private function getPermission($argument)
    {
        if (isset($argument['boolValue'])) {
            return $argument['boolValue'];
        } elseif (isset($argument['textValue'])) {
            return 'true' == $argument['textValue'];
        } else {
            return false;
        }
    }

    /**
     * Get option argument.
     *
     * @param array $argument
     *
     * @return string
     */
    private function getOption($argument)
    {
        return $argument['textValue'];
    }

    /**
     * Get datetime argument.
     *
     * @param array $argument
     *
     * @return Carbon\Carbon
     */
    private function getDateTime($argument)
    {
        $datetimeValue = $argument['datetimeValue'];

        $year = $datetimeValue['date']['year'];
        $month = $datetimeValue['date']['month'];
        $day = $datetimeValue['date']['day'];

        $hours = $datetimeValue['time']['hours'];
        $minutes = isset($datetimeValue['time']['minutes']) ? $datetimeValue['time']['minutes'] : 0;

        return Carbon::create($year, $month, $day, $hours, $minutes, 0);
    }

    /**
     * Get place argument.
     *
     * @param array $argument
     *
     * @return Dialogflow\Action\Types\Location
     */
    private function getPlace($argument)
    {
        return new Location($argument['placeValue']);
    }
}
