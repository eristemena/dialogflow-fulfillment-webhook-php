<?php

namespace Dialogflow\Action\Questions;

use Dialogflow\Action\Interfaces\QuestionInterface;
use Dialogflow\Action\Questions\Carousel\Option;

class Carousel implements QuestionInterface
{
    /** @var string */
    protected $imageDisplayOptions;

    /**
     * Create a new Carousel instance.
     *
     * @return Dialogflow\Action\Questions\Carousel
     */
    public static function create()
    {
        return new self();
    }

    /**
     * Type of image display option. Possible value: DEFAULT, WHITE and CROPPED.
     *
     * @param string $imageDisplayOptions
     *
     * @return Dialogflow\Action\Questions\Carousel
     */
    public function imageDisplayOptions($imageDisplayOptions)
    {
        $this->imageDisplayOptions = $imageDisplayOptions;

        return $this;
    }

    /**
     * Add Carousel option.
     *
     * @param \Dialogflow\Action\Questions\Carousel\Option $option
     *
     * @return Dialogflow\Action\Questions\Carousel
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
            '@type'          => 'type.googleapis.com/google.actions.v2.OptionValueSpec',
            'carouselSelect' => [
                'imageDisplayOptions' => $this->imageDisplayOptions,
                'items'               => $items,
            ],
        ];

        return $out;
    }
}
