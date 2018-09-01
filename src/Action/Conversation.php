<?php

namespace Dialogflow\Action;

use Dialogflow\Action\Interfaces\LinkOutSuggestionInterface;
use Dialogflow\Action\Interfaces\QuestionInterface;
use Dialogflow\Action\Interfaces\ResponseInterface;
use Dialogflow\Action\Interfaces\SuggestionInterface;
use Dialogflow\Action\Responses\SimpleResponse;
use Dialogflow\RichMessage\Payload;

class Conversation
{
    /** @var null|string */
    protected $id;

    /** @var bool */
    protected $expectUserResponse = true;

    /** @var bool */
    protected $sandbox = false;

    /** @var Dialogflow\Action\Surface */
    protected $surface;

    /** @var null|Dialogflow\Action\AvailableSurfaces */
    protected $availableSurfaces;

    /** @var null|Dialogflow\Action\User */
    protected $user;

    /** @var null|Dialogflow\Action\Device */
    protected $device;

    /** @var null|Dialogflow\Action\Arguments */
    protected $arguments;

    /** @var array */
    protected $messages = [];

    /**
     * Constructor for Conversation object.
     *
     * @param array $payload original payload from google
     */
    public function __construct($payload)
    {
        if (isset($payload['conversation']['conversationId'])) {
            $this->id = $payload['conversation']['conversationId'];
        }

        if (isset($payload['isInSandbox'])) {
            $this->sandbox = $payload['isInSandbox'];
        }

        $this->surface = new Surface($payload['surface']);

        if (isset($payload['availableSurfaces'])) {
            $this->availableSurfaces = new AvailableSurfaces($payload['availableSurfaces']);
        }

        if (isset($payload['inputs'][0]['arguments'])) {
            $this->arguments = new Arguments($payload['inputs'][0]['arguments']);
        }

        if (isset($payload['user'])) {
            $this->user = new User($payload['user']);
        }

        if (isset($payload['device'])) {
            $this->device = new Device($payload['device']);
        }
    }

    /**
     * Add a message.
     *
     * @param string|Dialogflow\Action\Interfaces\ResponseInterface|Dialogflow\Action\Interfaces\QuestionInterface $message
     *
     * @return Conversation
     */
    public function add($message)
    {
        if (is_string($message)) {
            $this->messages[] = new SimpleResponse($message);
        } elseif ($message instanceof ResponseInterface) {
            $this->messages[] = $message;
        } elseif ($message instanceof QuestionInterface) {
            $this->messages[] = $message;
        }

        return $this;
    }

    /**
     * Asks to collect user's input.
     * Follow [the guidelines](https://developers.google.com/actions/policies/general-policies#user_experience) when prompting the user for a response.
     *
     * @param string|Dialogflow\Action\Interfaces\ResponseInterface|Dialogflow\Action\Interfaces\QuestionInterface $message
     *
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
     * @param string|Dialogflow\Action\Interfaces\ResponseInterface|Dialogflow\Action\Interfaces\QuestionInterface $message
     *
     * @return Conversation
     */
    public function close($message)
    {
        $this->expectUserResponse = false;

        $this->add($message);

        return $this;
    }

    /**
     * @return Dialogflow\Action\Surface
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * @return Dialogflow\Action\AvailableSurfaces
     */
    public function getAvailableSurfaces()
    {
        return $this->availableSurfaces;
    }

    /**
     * @return Dialogflow\Action\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return null|Dialogflow\Action\Device
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @return Dialogflow\Action\Arguments
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Render response as array.
     *
     * @return array
     */
    public function render()
    {
        $out = [];

        $out['expectUserResponse'] = $this->expectUserResponse;

        $items = [];
        $suggestions = [];
        $linkOutSuggestion = null;
        foreach ($this->messages as $message) {
            if ($message instanceof ResponseInterface) {
                $item = $message->renderRichResponseItem();

                if ($item) {
                    $items[] = $item;
                }
            }

            if ($message instanceof SuggestionInterface) {
                $rendered = $message->renderRichResponseSuggestion();

                if (is_array($rendered)) {
                    foreach ($rendered as $suggestion) {
                        $suggestions[] = ['title' => $suggestion];
                    }
                } elseif (is_string($rendered)) {
                    $suggestions[] = ['title' => $rendered];
                } else {
                    // do nothing
                }
            }

            if ($message instanceof LinkOutSuggestionInterface) {
                $linkOutSuggestion = $message->renderRichResponseLinkOutSuggestion();
            }

            if ($message instanceof QuestionInterface) {
                if ($item = $message->renderRichResponseItem()) {
                    $items[] = $item;
                }
            }
        }

        $out['richResponse']['items'] = $items;

        if (count($suggestions) > 0) {
            $out['richResponse']['suggestions'] = $suggestions;
        }

        if ($linkOutSuggestion) {
            $out['richResponse']['linkOutSuggestion'] = $linkOutSuggestion;
        }

        $systemIntent = null;
        foreach ($this->messages as $message) {
            if ($message instanceof QuestionInterface) {
                $systemIntent = $message->renderSystemIntent();
            }
        }

        if ($systemIntent) {
            $out['systemIntent'] = $systemIntent;
        }

        return $out;
    }
}
