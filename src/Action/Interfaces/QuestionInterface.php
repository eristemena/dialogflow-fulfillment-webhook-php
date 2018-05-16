<?php

namespace Dialogflow\Action\Interfaces;

interface QuestionInterface
{
    /**
     * Render a single Rich Response item as array.
     *
     * @return null|array
     */
    public function renderRichResponseItem();

    /**
     * Render System Intent as array.
     *
     * @return null|array
     */
    public function renderSystemIntent();
}
