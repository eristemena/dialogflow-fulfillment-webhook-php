<?php

namespace Dialogflow\Action\Questions;

use Dialogflow\Action\Interfaces\QuestionInterface;
use Dialogflow\Action\Questions\ListCard\Option;

class ListCard implements QuestionInterface
{
    /** @var string */
    protected $title;

    /**
     * Create a new List instance.
     *
     * @return Dialogflow\Action\Questions\ListCard
     */
    public static function create()
    {
        return new self();
    }

    /**
     * List title.
     *
     * @param string $title
     *
     * @return Dialogflow\Action\Questions\ListCard
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Add list option.
     *
     * @param \Dialogflow\Action\Questions\ListCard\Option $option
     *
     * @return Dialogflow\Action\Questions\ListCard
     */
    public function addOption(Option $option)
    {
        $this->options[] = $option;

        return $this;
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
     * Render System Intent as array.
     *
     * @return null|array
     */
    public function renderSystemIntent()
    {
        $out = [];
        $items = [];

        foreach ($this->options as $option) {
            $items[] = $option->render();
        }

        $out['intent'] = 'actions.intent.OPTION';
        $out['data'] = [
            '@type'      => 'type.googleapis.com/google.actions.v2.OptionValueSpec',
            'listSelect' => [
                'title' => $this->title,
                'items' => $items,
            ],
        ];

        return $out;
    }
}
