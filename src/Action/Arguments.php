<?php

namespace Dialogflow\Action;

class Arguments
{
    /** @var array */
    protected $arguments = [];

    protected $mapArgumentName = [
        'CONFIRMATION' => 'getConfirmation'
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
     */
    public function get($name)
    {
        foreach ($this->arguments as $argument) {
            if ($argument['name']==$name) {
                if (isset($this->mapArgumentName[$name])) {
                    return $this->{$this->mapArgumentName[$name]}($argument);
                } else {
                    return $argument;
                }
            }
        }

        return null;
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
}
