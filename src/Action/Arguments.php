<?php

namespace Dialogflow\Action;

class Arguments
{
    /** @var array */
    protected $arguments = [];

    protected $mapArgumentName = [
        'CONFIRMATION' => 'getConfirmation',
        'PERMISSION'   => 'getPermission',
        'OPTION'       => 'getOption',
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
}
