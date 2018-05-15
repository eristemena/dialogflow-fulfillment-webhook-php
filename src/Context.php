<?php

namespace Dialogflow;

class Context
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $lifespan;

    /** @var array */
    protected $parameters;

    public function __construct($name, $lifespan = null, $parameters = null)
    {
        $this->name = $name;
        $this->lifespan = $lifespan;
        $this->parameters = $parameters;
    }

    /**
     * The name of the context.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * The number of queries this context will remain active after being invoked.
     *
     * @return null|string
     */
    public function getLifespan()
    {
        return $this->lifespan;
    }

    /**
     * The parameters being passed through the context.
     *
     * @return null|array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
