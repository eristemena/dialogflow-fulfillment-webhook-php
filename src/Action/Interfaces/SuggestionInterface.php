<?php

namespace Dialogflow\Action\Interfaces;

interface SuggestionInterface extends ResponseInterface
{
    /**
     * Render Rich Response suggestions as array.
     *
     * @return null|string|array
     */
    public function renderRichResponseSuggestion();
}
