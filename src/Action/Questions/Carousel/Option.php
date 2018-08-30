<?php

namespace Dialogflow\Action\Questions\Carousel;

class Option
{
    /** @var string */
    protected $key;

    /** @var string */
    protected $title;

    /** @var string */
    protected $description;

    /** @var array */
    protected $synonyms = [];

    /** @var string */
    protected $imageUrl;

    /** @var string */
    protected $accessibilityText;

    /**
     * Create a new Option instance.
     *
     * @return Dialogflow\Action\Questions\Carousel\Option
     */
    public static function create()
    {
        return new self();
    }

    /**
     * Option key that will be used to capture user's response.
     *
     * @param string $key
     *
     * @return Dialogflow\Action\Questions\Carousel\Option
     */
    public function key($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Possible synonyms of the option that can be said/typed by user to select this option.
     *
     * @param array $synonyms
     *
     * @return Dialogflow\Action\Questions\Carousel\Option
     */
    public function synonyms($synonyms)
    {
        $this->synonyms = $synonyms;

        return $this;
    }

    /**
     * Option title.
     *
     * @param string $title
     *
     * @return Dialogflow\Action\Questions\Carousel\Option
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
     * @return Dialogflow\Action\Questions\Carousel\Option
     */
    public function description($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set the image for Carousel option.
     *
     * @param string $imageUrl          image URL
     * @param string $accessibilityText (optional) accessibility text of the image
     *
     * @return Dialogflow\Action\Questions\Carousel\Option
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

        $optionInfo['key'] = $this->key;
        $optionInfo['synonyms'] = $this->synonyms;
        $out['optionInfo'] = $optionInfo;

        if ($this->title) {
            $out['title'] = $this->title;
        }

        if ($this->description) {
            $out['description'] = $this->description;
        }

        if ($this->imageUrl) {
            $out['image'] = [
                'url'               => $this->imageUrl,
                'accessibilityText' => ($this->accessibilityText) ? $this->accessibilityText : 'accessibility text',
            ];
        }

        return $out;
    }
}
