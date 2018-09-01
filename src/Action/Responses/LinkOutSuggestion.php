<?php

namespace Dialogflow\Action\Responses;

use Dialogflow\Action\Interfaces\LinkOutSuggestionInterface;

class LinkOutSuggestion implements LinkOutSuggestionInterface
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $url;

    /**
     * Create a new LinkOutSuggestion instance.
     *
     * @param string $name the name of the app or site this chip is linking to
     * @param string $url  URL
     *
     * @return Dialogflow\Action\Responses\LinkOutSuggestion
     */
    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    /**
     * Render a single Rich Response item as array.
     *
     * @return null|array
     */
    public function renderRichResponseItem()
    {
    }

    /**
     * Render Rich Response suggestions as array.
     *
     * @return null|string|array
     */
    public function renderRichResponseLinkOutSuggestion()
    {
        return [
            'destinationName' => $this->name,
            'openUrlAction'   => [
                'url' => $this->url,
            ],
        ];
    }
}
