<?php

namespace Dialogflow\Action\Interfaces;

interface LinkOutSuggestionInterface extends ResponseInterface
{
    /**
     * Render Rich Response link out suggestions as array.
     *
     * @return null|array
     */
    public function renderRichResponseLinkOutSuggestion();
}
