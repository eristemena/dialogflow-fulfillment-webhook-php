<?php

namespace Dialogflow\RichMessage;

class Image extends RichMessage
{
    /**
     * Enum for Dialogflow v1 text message object
     * https://dialogflow.com/docs/reference/agent/message-objects.
     */
    const v1MessageObjectImage = 3;

    /** @var string */
    protected $imageUrl;

    /**
     * Create a new Image instance.
     *
     * @param string $image image URL
     *
     * @return Dialogflow\Response\Image
     */
    public static function create($imageUrl = null)
    {
        $image = new self();
        $image->image($imageUrl);

        return $image;
    }

    /**
     * Set the image for a Image.
     *
     * @param string $imageUrl
     */
    public function image($imageUrl)
    {
        $this->imageUrl = $imageUrl;

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
                'type'     => 'basic_card',
                'platform' => $this->requestSource,
            ];

            if ($this->imageUrl) {
                $out['image'] = [
                    'url'               => $this->imageUrl,
                    'accessibilityText' => 'accessibility text',
                ];
            }

            return $out;
        } else {
            $out = [
                'type'     => self::v1MessageObjectImage,
                'platform' => $this->requestSource,
            ];

            if ($this->imageUrl) {
                $out['imageUrl'] = $this->imageUrl;
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
                'basicCard' => [],
                'platform'  => $this->v2PlatformMap[$this->requestSource],
            ];

            if ($this->imageUrl) {
                $out['basicCard']['image'] = [
                    'imageUri'          => $this->imageUrl,
                    'accessibilityText' => 'accessibility text',
                ];
            }

            return $out;
        } else {
            $out = [
                'image'    => [],
                'platform' => $this->v2PlatformMap[$this->requestSource],
            ];

            if ($this->imageUrl) {
                $out['image']['imageUri'] = $this->imageUrl;
            }

            return $out;
        }
    }
}
