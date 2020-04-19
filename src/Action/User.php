<?php

namespace Dialogflow\Action;

use Carbon\Carbon;
use Dialogflow\Action\User\Name;
use Dialogflow\Action\User\Storage;

class User
{
    /** @var null|Dialogflow\Action\User\Name */
    protected $name;

    /** @var null|Dialogflow\Action\User\Storage */
    protected $storage;

    /** @var null|Carbon\Carbon * */
    protected $lastSeen;

    /**
     * @param array $data request array
     */
    public function __construct($data)
    {
        if (isset($data['profile'])) {
            $this->name = new Name($data['profile']);
        }

        if (isset($data['userStorage']) && count(get_object_vars(json_decode($data['userStorage'])->data))) {
            $this->storage = new Storage(json_decode($data['userStorage']));
        } else {
            $this->storage = new Storage(json_decode(''));
        }

        if (isset($data['lastSeen'])) {
            $this->lastSeen = new Carbon($data['lastSeen']);
        }
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
     * User's session storage.
     *
     * @return null|Dialogflow\Action\User\Storage
     */
    public function getStorage()
    {
        return $this->storage;
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
