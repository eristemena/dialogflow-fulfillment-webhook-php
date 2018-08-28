<?php

namespace Dialogflow\Action\Questions;

use Dialogflow\Action\Interfaces\QuestionInterface;

class DateTime implements QuestionInterface
{
    /** @var string */
    protected $requestDateTimeText;

    /** @var string */
    protected $requestDateText;

    /** @var string */
    protected $requestTimeText;

    /**
     * Constructor for DateTime object.
     *
     * @param string $requestDateTimeText initial question
     * @param string $requestDateText     follow up question about the exact date
     * @param string $requestTimeText     follow up question about the exact time
     *
     * @return Dialogflow\Action\Questions\DateTime
     */
    public function __construct($requestDateTimeText, $requestDateText, $requestTimeText)
    {
        $this->requestDateTimeText = $requestDateTimeText;
        $this->requestDateText = $requestDateText;
        $this->requestTimeText = $requestTimeText;
    }

    /**
     * Render a single Rich Response item as array.
     *
     * @return null|array
     */
    public function renderRichResponseItem()
    {
        $out = [];

        $out['simpleResponse'] = ['textToSpeech' => 'PLACEHOLDER'];

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

        $out['intent'] = 'actions.intent.DATETIME';
        $out['data'] = [
            '@type'      => 'type.googleapis.com/google.actions.v2.DateTimeValueSpec',
            'dialogSpec' => [
                'requestDatetimeText' => $this->requestDateTimeText,
                'requestDateText'     => $this->requestDateText,
                'requestTimeText'     => $this->requestTimeText,
            ],
        ];

        return $out;
    }
}
