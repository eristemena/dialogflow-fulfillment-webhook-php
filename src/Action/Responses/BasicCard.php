<?php

namespace Dialogflow\Action\Responses;

use Dialogflow\Action\Interfaces\ResponseInterface;

class BasicCard implements ResponseInterface
{
    /** @var string */
    protected $title;

    /** @var string */
    protected $formattedText;

    /** @var string */
    protected $imageUrl;

    /** @var string */
    protected $accessibilityText;

    /** @var string */
    protected $buttonText;

    /** @var string */
    protected $buttonUrl;

    /**
     * Create a new Basic Card instance.
     *
     * @return Dialogflow\Action\Responses\BasicCard
     */
    public static function create()
    {
        return new self();
    }

    /**
     * Set the title for a Card.
     *
     * @param string $title
     *
     * @return Dialogflow\Action\Responses\BasicCard
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set the formattedText for a Card.
     *
     * @param string $formattedText
     *
     * @return Dialogflow\Action\Responses\BasicCard
     */
    public function formattedText($formattedText)
    {
        $this->formattedText = $formattedText;

        return $this;
    }

    /**
     * Set the image for a Card.
     *
     * @param string $imageUrl          image URL
     * @param string $accessibilityText (optional) accessibility text of the image
     *
     * @return Dialogflow\Action\Responses\BasicCard
     */
    public function image($imageUrl, $accessibilityText = null)
    {
        $this->imageUrl = $imageUrl;
        $this->accessibilityText = $accessibilityText;

        return $this;
    }

    /**
     * Set the button for a Card.
     *
     * @param string $buttonText button text
     * @param string $buttonUrl  button link URL
     *
     * @return Dialogflow\Action\Responses\BasicCard
     */
    public function button($buttonText, $buttonUrl)
    {
        $this->buttonText = $buttonText;
        $this->buttonUrl = $buttonUrl;

        return $this;
    }

    /**
     * Render a single Rich Response item as array.
     *
     * @return null|array
     */
    public function renderRichResponseItem()
    {
        $out = [];
        $basicCard = [];

        if ($this->title) {
            $basicCard['title'] = $this->title;
        }

        if ($this->formattedText) {
            $basicCard['formattedText'] = $this->formattedText;
        }

        if ($this->imageUrl) {
            $basicCard['image'] = [
                'url'               => $this->imageUrl,
                'accessibilityText' => ($this->accessibilityText) ? $this->accessibilityText : 'accessibility text',
            ];
        }

        if ($this->buttonText && $this->buttonUrl) {
            $basicCard['buttons'] = [
                [
                    'title'         => $this->buttonText,
                    'openUrlAction' => [
                        'url' => $this->buttonUrl,
                    ],
                ],
            ];
        }

        $out['basicCard'] = $basicCard;

        return $out;
    }
}
