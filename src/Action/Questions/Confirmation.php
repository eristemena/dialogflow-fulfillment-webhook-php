<?php

namespace Dialogflow\Action\Questions;

use Dialogflow\Action\Interfaces\QuestionInterface;

class Confirmation implements QuestionInterface
{
    /** @var string */
    protected $requestConfirmationText;

    /**
     * Constructor for Confirmation object.
     *
     * @param string $requestConfirmationText
     *
     * @return Dialogflow\Action\Questions\Confirmation
     */
    public function __construct($requestConfirmationText)
    {
        $this->requestConfirmationText = $requestConfirmationText;
    }

    /**
     * Render a single Rich Response item as array.
     *
     * @return null|array
     */
    public function renderRichResponseItem()
    {
        $out = [];

        $out['simpleResponse'] = ['textToSpeech' => 'PLACEHOLDER_FOR_CONFIRMATION'];

        return $out;
    }

    /**
     * Render System Intent as array.
     *
     * @return null|array
     */
    public function renderSystemIntent()
    {
        $out = [];

        $out['intent'] = 'actions.intent.CONFIRMATION';
        $out['data'] = [
            '@type'      => 'type.googleapis.com/google.actions.v2.ConfirmationValueSpec',
            'dialogSpec' => [
                'requestConfirmationText' => $this->requestConfirmationText,
            ],
        ];

        return $out;
    }
}
