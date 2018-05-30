<?php

namespace Dialogflow\Action\User;

class Name
{
    /** @var null|string */
    protected $display;

    /** @var null|string */
    protected $family;

    /** @var null|string */
    protected $given;

    /**
     * @param array $data request array
     */
    public function __construct($data)
    {
        if (isset($data['displayName'])) {
            $this->display = $data['displayName'];
        }

        if (isset($data['familyName'])) {
            $this->family = $data['familyName'];
        }

        if (isset($data['givenName'])) {
            $this->given = $data['givenName'];
        }
    }

    /**
     * User's display name.
     *
     * @return string
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * User's family name.
     *
     * @return string
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * User's given name.
     *
     * @return string
     */
    public function getGiven()
    {
        return $this->given;
    }
}
