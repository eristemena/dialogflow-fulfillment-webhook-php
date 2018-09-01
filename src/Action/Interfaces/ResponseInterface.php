<?php

namespace Dialogflow\Action\Interfaces;

interface ResponseInterface
{
    /**
     * Render a single Rich Response item as array.
     *
     * @return null|array
     */
    public function renderRichResponseItem();
}
