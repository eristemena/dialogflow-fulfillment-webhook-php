<?php

namespace Dialogflow\Action\Questions;

use Dialogflow\Action\Interfaces\QuestionInterface;

class Place implements QuestionInterface
{
    /**
     * This is the initial response by location sub-dialog.
     * For example: "Where do you want to get picked up?".
     *
     * @var string
     */
    protected $requestPrompt;

    /**
     * This is the context for seeking permissions.
     * For example: "To find a place to pick you up"
     * Prompt to user: "*To find a place to pick you up*, I just need to check your location.
     *     Can I get that from Google?".
     *
     * @var string
     */
    protected $permissionContext;

    /**
     * Constructor for Place object.
     *
     * @param string $requestPrompt     initial question
     * @param string $permissionContext the context for seeking permissions
     *
     * @return Dialogflow\Action\Questions\Place
     */
    public function __construct($requestPrompt, $permissionContext)
    {
        $this->requestPrompt = $requestPrompt;
        $this->permissionContext = $permissionContext;
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

        $out['intent'] = 'actions.intent.PLACE';
        $out['data'] = [
            '@type'      => 'type.googleapis.com/google.actions.v2.PlaceValueSpec',
            'dialogSpec' => [
                'extension' => [
                    '@type'                 => 'type.googleapis.com/google.actions.v2.PlaceValueSpec.PlaceDialogSpec',
                    'requestPrompt'         => $this->requestPrompt,
                    'permissionContext'     => $this->permissionContext,
                ],
            ],
        ];

        return $out;
    }
}
