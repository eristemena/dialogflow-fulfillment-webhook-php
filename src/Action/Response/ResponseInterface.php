<?php

namespace Dialogflow\Action\Response;

interface ResponseInterface
{
    /**
     * Render response as array
     *
     * @return array
     */
    public function render();
}
