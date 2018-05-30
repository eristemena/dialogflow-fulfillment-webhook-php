<?php

namespace Dialogflow\Action;

use Carbon\Carbon;
use Dialogflow\Action\User\Name;

class User
{
    /** @var string */
    protected $id;

    /** @var null|Dialogflow\Action\User\Name */
    protected $name;

    /** @var null|Carbon\Carbon * */
    protected $lastSeen;

    /**
     * @param array $data request array
     */
    public function __construct($data)
    {
        $this->id = $data['userId'];

        if (isset($data['profile'])) {
            $this->name = new Name($data['profile']);
        }

        if (isset($data['lastSeen'])) {
            $this->lastSeen = new Carbon($data['lastSeen']);
        }
    }

    /**
     * Random string ID for Google user.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * User's permissioned name info.
     *
     * @return null|Dialogflow\Action\User\Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Timestamp for the last access from the user.
     *
     * @return null|Carbon\Carbon
     */
    public function getLastSeen()
    {
        return $this->lastSeen;
    }
}
