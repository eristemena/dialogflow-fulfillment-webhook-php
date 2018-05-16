<?php

namespace Dialogflow\Action\Interfaces;

interface ResponseInterface
{
    /**
     * Render response as array.
     *
     * @return array
     */
    public function render();
}
