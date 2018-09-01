<?php

namespace Dialogflow\Action\Responses;

use Dialogflow\Action\Interfaces\ResponseInterface;

class Image implements ResponseInterface
{
    /**
     * Create a new Image instance.
     *
     * @param string $imageUrl          image URL
     * @param string $accessibilityText (optional) accessibility text of the image
     *
     * @return Dialogflow\Action\Responses\Image
     */
    public function __construct($imageUrl, $accessibilityText = null)
    {
        $this->imageUrl = $imageUrl;
        $this->accessibilityText = $accessibilityText;
    }

    /**
     * Create a new Image instance.
     *
     * @param string $imageUrl          image URL
     * @param string $accessibilityText (optional) accessibility text of the image
     *
     * @return Dialogflow\Action\Responses\Image
     */
    public static function create($imageUrl, $accessibilityText = null)
    {
        return new self($imageUrl, $accessibilityText);
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

        if ($this->imageUrl) {
            $basicCard['image'] = [
                'url'               => $this->imageUrl,
                'accessibilityText' => ($this->accessibilityText) ? $this->accessibilityText : 'accessibility text',
            ];
        }

        $out['basicCard'] = $basicCard;

        return $out;
    }
}
