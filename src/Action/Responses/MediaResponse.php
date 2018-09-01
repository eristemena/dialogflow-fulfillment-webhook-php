<?php

namespace Dialogflow\Action\Responses;

use Dialogflow\Action\Interfaces\ResponseInterface;

class MediaResponse implements ResponseInterface
{
    /** @var array */
    protected $mediaObjects = [];

    /**
     * Create a new MediaResponse instance.
     *
     * @param null|Dialogflow\Action\Responses\MediaObject $mediaObject Media objects
     *
     * @return Dialogflow\Action\Responses\MediaResponse
     */
    public function __construct($mediaObject = null)
    {
        if ($mediaObject instanceof MediaObject) {
            $this->mediaObjects[] = $mediaObject;
        }
    }

    /**
     * Create a new MediaResponse instance.
     *
     * @param null|Dialogflow\Action\Responses\MediaObject $mediaObject Media objects
     *
     * @return Dialogflow\Action\Responses\MediaResponse
     */
    public static function create($mediaObject = null)
    {
        return new self($mediaObject);
    }

    /**
     * Add MediaObject.
     *
     * @param Dialogflow\Action\Responses\MediaObject $mediaObject
     *
     * @return Dialogflow\Action\Responses\MediaResponse
     */
    public function add($mediaObject)
    {
        $this->mediaObjects[] = $mediaObject;

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
        $mediaResponse = [];

        $mediaResponse['mediaType'] = 'AUDIO';

        $mediaObjects = [];
        foreach ($this->mediaObjects as $mediaObject) {
            $mediaObjects[] = $mediaObject->render();
        }

        if (count($mediaObjects) > 0) {
            $mediaResponse['mediaObjects'] = $mediaObjects;
        }

        $out['mediaResponse'] = $mediaResponse;

        return $out;
    }
}
