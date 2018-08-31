<?php

namespace Dialogflow\Action\Responses\BrowseCarousel;

class Option
{
    /** @var string */
    protected $title;

    /** @var string */
    protected $description;

    /** @var string */
    protected $footer;

    /** @var string */
    protected $openUrlAction;

    /** @var string */
    protected $imageUrl;

    /** @var string */
    protected $accessibilityText;

    /**
     * Create a new Option instance.
     *
     * @return Dialogflow\Action\Responses\BrowseCarousel\Option
     */
    public static function create()
    {
        return new self();
    }

    /**
     * Option title.
     *
     * @param string $title
     *
     * @return Dialogflow\Action\Responses\BrowseCarousel\Option
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Option description.
     *
     * @param string $description
     *
     * @return Dialogflow\Action\Responses\BrowseCarousel\Option
     */
    public function description($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Hero image for the carousel item. Optional.
     *
     * @param string $footer
     *
     * @return Dialogflow\Action\Responses\BrowseCarousel\Option
     */
    public function footer($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * URL of the document associated with the carousel item.
     * The document can contain HTML content or, if \"url_type_hint\" is set to
     * AMP_CONTENT, AMP content.
     * Required.
     *
     * @param string $openUrlAction
     *
     * @return Dialogflow\Action\Responses\BrowseCarousel\Option
     */
    public function url($openUrlAction)
    {
        $this->openUrlAction = $openUrlAction;

        return $this;
    }

    /**
     * Set the image for Browsing Carousel option.
     *
     * @param string $imageUrl          image URL
     * @param string $accessibilityText (optional) accessibility text of the image
     *
     * @return Dialogflow\Action\Responses\BrowseCarousel\Option
     */
    public function image($imageUrl, $accessibilityText = null)
    {
        $this->imageUrl = $imageUrl;
        $this->accessibilityText = $accessibilityText;

        return $this;
    }

    /**
     * Render response as array.
     *
     * @return array
     */
    public function render()
    {
        $out = [];
        $optionInfo = [];

        if ($this->title) {
            $out['title'] = $this->title;
        }

        if ($this->description) {
            $out['description'] = $this->description;
        }

        if ($this->footer) {
            $out['footer'] = $this->footer;
        }

        if ($this->imageUrl) {
            $out['image'] = [
                'url'               => $this->imageUrl,
                'accessibilityText' => ($this->accessibilityText) ? $this->accessibilityText : 'accessibility text',
            ];
        }

        $out['openUrlAction'] = [
            'url' => $this->openUrlAction,
        ];

        return $out;
    }
}
