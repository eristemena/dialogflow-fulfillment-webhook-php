<?php

namespace Dialogflow\RichMessage;

class Text extends RichMessage
{
    /**
     * Enum for Dialogflow v1 text message object
     * https://dialogflow.com/docs/reference/agent/message-objects.
     */
    const v1MessageObjectText = 0;

    /** @var string */
    protected $text;

    /** @var string */
    protected $ssml;

    /**
     * Create a new Text instance.
     *
     * @return Dialogflow\Response\Text
     */
    public static function create()
    {
        return new self();
    }

    /**
     * Set the text for a Text.
     *
     * @param string $text containing the text response content
     */
    public function text($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Set the SSML for a Text.
     *
     * @param string $text containing the SSML response content
     */
    public function ssml($ssml)
    {
        $this->ssml = $ssml;

        return $this;
    }

    /**
     * Render response as array for API V1.
     *
     * @return array
     */
    protected function renderV1()
    {
        if ('google' == $this->requestSource) {
            return [
                'type'         => 'simple_response',
                'platform'     => $this->requestSource,
                'textToSpeech' => $this->text,
                'displayText'  => $this->text,
            ];
        } else {
            $out = [
                'type'   => self::v1MessageObjectText,
                'speech' => $this->text,
            ];

            if (in_array($this->requestSource, $this->supportedRichMessagePlatforms)) {
                $out['platform'] = $this->requestSource;
            }

            return $out;
        }
    }

    /**
     * Render response as array for API V2.
     *
     * @return array
     */
    protected function renderV2()
    {
        if ('google' == $this->requestSource) {
            $out = [
                'platform'        => 'ACTIONS_ON_GOOGLE',
                'simpleResponses' => [
                    'simpleResponses' => [],
                ],
            ];

            if ($this->ssml) {
                $out['simpleResponses']['simpleResponses'][0]['ssml'] = $this->ssml;
            } else {
                $out['simpleResponses']['simpleResponses'][0]['textToSpeech'] = $this->text;
            }

            $out['simpleResponses']['simpleResponses'][0]['displayText'] = $this->text;

            return $out;
        } else {
            $out = [
                'text' => [
                    'text' => [$this->text],
                ],
            ];

            if (in_array($this->requestSource, $this->supportedRichMessagePlatforms)) {
                $out['platform'] = $this->v2PlatformMap[$this->requestSource];
            }

            return $out;
        }
    }
}
