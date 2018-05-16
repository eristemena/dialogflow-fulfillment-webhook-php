<?php

namespace Dialogflow\Action\Responses;

use Dialogflow\Action\Interfaces\ResponseInterface;

class SimpleResponse implements ResponseInterface
{
    /** @var null|string */
    protected $displayText;

    /** @var null|string */
    protected $ssml;

    /** @var null|string */
    protected $textToSpeech;

    public function __construct($options = null)
    {
        if (is_string($options)) {
            $this->textToSpeech = $options;
        } elseif (is_array($options)) {
            $this->displayText = isset($options['displayText']) ?: $options['displayText'];
            $this->ssml = isset($options['ssml']) ?: $options['ssml'];
            $this->textToSpeech = isset($options['textToSpeech']) ?: $options['textToSpeech'];
        }
    }

    /**
     * Create a new instance.
     *
     * @return Dialogflow\Action\Responses\SimpleResponse
     */
    public static function create()
    {
        return new self();
    }

    /**
     * Set display text.
     *
     * @param string $displayText
     *
     * @return Dialogflow\Action\Responses\SimpleResponse
     */
    public function displayText($displayText)
    {
        $this->displayText = $displayText;

        return $this;
    }

    /**
     * Set ssml.
     *
     * @param string $ssml
     *
     * @return Dialogflow\Action\Responses\SimpleResponse
     */
    public function ssml($ssml)
    {
        $this->ssml = $ssml;

        return $this;
    }

    /**
     * Set text to speech.
     *
     * @param string $textToSpeech
     *
     * @return Dialogflow\Action\Responses\SimpleResponse
     */
    public function textToSpeech($textToSpeech)
    {
        $this->textToSpeech = $textToSpeech;

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
        $simpleResponse = [];

        if ($this->ssml) {
            $simpleResponse['ssml'] = $this->ssml;
        }

        if ($this->displayText) {
            $simpleResponse['displayText'] = $this->displayText;
        }

        if ($this->textToSpeech) {
            $simpleResponse['textToSpeech'] = $this->textToSpeech;
        }

        $out['simpleResponse'] = $simpleResponse;

        return $out;
    }
}
