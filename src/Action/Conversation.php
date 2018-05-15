<?php

namespace Dialogflow\Action;

use \Dialogflow\RichMessage\Payload;
use \Dialogflow\Action\Response\ResponseInterface;
use \Dialogflow\Action\Response\SimpleResponse;

class Conversation
{
    /** @var null|string */
    protected $id;

    /** @var boolean */
    protected $expectUserResponse = true;

    /** @var boolean */
    protected $sandbox = false;

    /** @var \Dialogflow\Action\Surface */
    protected $surface;

    /** @var \Dialogflow\Action\AvailableSurface */
    protected $availableSurface;

    /** @var array */
    protected $messages = [];

    /**
     * Constructor for Conversation object.
     *
     * @param array $payload original payload from google
     */
    public function __construct($payload)
    {
        $this->id = isset($payload['conversation']['conversationId']) ?: $payload['conversation']['conversationId'];
        $this->sandbox = isset($payload['isInSandbox']) ?: $payload['isInSandbox'];

        $this->surface = new Surface($payload['surface']);

        $this->availableSurface = new AvailableSurface($payload['availableSurfaces']);
    }

    /**
     * Add a message.
     *
     * @param string|\Dialogflow\Action\Response\ResponseInterface $message
     * @return Conversation
     */
    public function add($message)
    {
        if (is_string($message)) {
            $this->messages[] = new SimpleResponse($message);
        } elseif ($message instanceof ResponseInterface) {
            $this->messages[] = $message;
        }

        return $this;
    }

    /**
     * Asks to collect user's input.
     * Follow [the guidelines](https://developers.google.com/actions/policies/general-policies#user_experience) when prompting the user for a response.
     *
     * @param string|\Dialogflow\Action\Response\ResponseInterface $message
     * @return Conversation
     */
    public function ask($message)
    {
        $this->expectUserResponse = true;

        $this->add($message);

        return $this;
    }

    /**
     * Have Assistant render the speech response and close the mic.
     *
     * @param string|\Dialogflow\Action\Response\ResponseInterface $message
     * @return Conversation
     */
    public function close($message)
    {
        $this->expectUserResponse = false;

        $this->add($message);

        return $this;
    }

    /**
     * @return \Dialogflow\Action\Surface
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * @return \Dialogflow\Action\AvailableSurface
     */
    public function getAvailableSurface()
    {
        return $this->availableSurface;
    }

    /**
     * Render response as array
     *
     * @return array
     */
    public function render()
    {
        $out = [];

        $out['expectUserResponse'] = $this->expectUserResponse;

        $items = [];
        foreach ($this->messages as $message) {
            $items[] = $message->render();
        }

        $out['richResponse']['items'] = $items;

        return $out;
    }
}
