<?php

namespace Dialogflow\Action\Responses;

use Dialogflow\Action\Interfaces\SuggestionInterface;

class Suggestions implements SuggestionInterface
{
    /**
     * Create a new Suggestions instance.
     *
     * @param string|array $imageUrl suggestions
     *
     * @return Dialogflow\Action\Responses\Suggestions
     */
    public function __construct($suggestions)
    {
        $this->suggestions = $suggestions;
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
    public function renderRichResponseSuggestion()
    {
        return $this->suggestions;
    }
}
