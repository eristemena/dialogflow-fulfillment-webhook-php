<?php

namespace Dialogflow\RichMessage;

class Suggestion extends RichMessage
{
    /**
     * Enum for Dialogflow v1 text message object
     * https://dialogflow.com/docs/reference/agent/message-objects.
     */
    const v1MessageObjectSuggestions = 2;

    /** @var array */
    protected $replies = [];

    /**
     * Create a new Suggestion instance.
     *
     * @param string|array|null $reply
     *
     * @return Dialogflow\Response\Suggestion
     */
    public static function create($reply = null)
    {
        $suggestion = new self();

        if ($reply) {
            $suggestion->reply($reply);
        }

        return $suggestion;
    }

    /**
     * Set the reply for a Suggestion.
     *
     * @param string|array $reply
     */
    public function reply($reply)
    {
        if (is_string($reply)) {
            $this->replies = [$reply];
        } elseif (is_array($reply)) {
            $this->replies = $reply;
        }

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
            $out = [
                'suggestions' => [],
                'type'        => 'suggestion_chips',
                'platform'    => $this->requestSource,
            ];

            foreach ($this->replies as $i => $reply) {
                $out['suggestions'][$i]['title'] = $reply;
            }

            return $out;
        } else {
            $out = [
                'type' => self::v1MessageObjectSuggestions,
            ];

            $out['replies'] = $this->replies;

            $out['platform'] = $this->requestSource;

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
                'suggestions' => [
                    'suggestions' => [],
                ],
            ];

            foreach ($this->replies as $i => $reply) {
                $out['suggestions']['suggestions'][$i]['title'] = $reply;
            }

            $out['platform'] = $this->v2PlatformMap[$this->requestSource];

            return $out;
        } else {
            $out = [
                'quickReplies' => [
                    'quickReplies' => $this->replies,
                ],
            ];

            $out['platform'] = $this->v2PlatformMap[$this->requestSource];

            return $out;
        }
    }
}
