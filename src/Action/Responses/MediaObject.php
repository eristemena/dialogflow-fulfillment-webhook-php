<?php

namespace Dialogflow\Action\Responses;

class MediaObject
{
    /** @var string */
    protected $url;

    /** @var null|string */
    protected $name;

    /** @var null|string */
    protected $description;

    /** @var null|string */
    protected $icon;

    /** @var null|string */
    protected $image;

    /**
     * Create a new MediaObject instance.
     *
     * @param string $url Media URL
     *
     * @return Dialogflow\Action\Responses\MediaObject
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Create a new MediaObject instance.
     *
     * @param string $url Media URL
     *
     * @return Dialogflow\Action\Responses\MediaObject
     */
    public static function create($url)
    {
        return new self($url);
    }

    /**
     * Set the Name of the MediaObject.
     *
     * @param string $name
     *
     * @return Dialogflow\Action\Responses\MediaObject
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the description of the MediaObject.
     *
     * @param string $description
     *
     * @return Dialogflow\Action\Responses\MediaObject
     */
    public function description($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set the icon of the MediaObject.
     *
     * @param string $icon
     *
     * @return Dialogflow\Action\Responses\MediaObject
     */
    public function icon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Set the large image of the MediaObject.
     *
     * @param string $image
     *
     * @return Dialogflow\Action\Responses\MediaObject
     */
    public function image($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Render as an array.
     *
     * @return null|array
     */
    public function render()
    {
        $mediaObject = [];
        $mediaObject['contentUrl'] = $this->url;

        if ($this->name) {
            $mediaObject['name'] = $this->name;
        }

        if ($this->description) {
            $mediaObject['description'] = $this->description;
        }

        if ($this->icon) {
            $mediaObject['icon'] = ['url' => $this->icon];
        }

        if ($this->image) {
            $mediaObject['largeImage'] = ['url' => $this->image];
        }

        return $mediaObject;
    }
}
