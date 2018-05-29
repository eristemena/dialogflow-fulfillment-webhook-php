<?php

namespace Dialogflow\Action;

class Surface
{
    const CAPABILITY_AUDIO = 'actions.capability.AUDIO_OUTPUT';
    const CAPABILITY_SCREEN = 'actions.capability.SCREEN_OUTPUT';
    const CAPABILITY_MEDIA_PLAYBACK = 'actions.capability.MEDIA_RESPONSE_AUDIO';
    const CAPABILITY_WEB_BROWSER = 'actions.capability.WEB_BROWSER';

    /** @var bool */
    protected $hasScreen = false;

    /** @var bool */
    protected $hasAudio = false;

    /** @var bool */
    protected $hasMediaPlayback = false;

    /** @var bool */
    protected $hasWebBrowser = false;

    /**
     * @param array $data request array
     */
    public function __construct($data)
    {
        foreach ($data['capabilities'] as $capability) {
            switch ($capability['name']) {
                case self::CAPABILITY_AUDIO:
                    $this->hasAudio = true;
                    break;

                case self::CAPABILITY_SCREEN:
                    $this->hasScreen = true;
                    break;

                case self::CAPABILITY_MEDIA_PLAYBACK:
                    $this->hasMediaPlayback = true;
                    break;

                case self::CAPABILITY_WEB_BROWSER:
                    $this->hasWebBrowser = true;
                    break;

                default:
                    break;
            }
        }
    }

    /**
     * @return bool
     */
    public function hasScreen()
    {
        return $this->hasScreen;
    }

    /**
     * @return bool
     */
    public function hasAudio()
    {
        return $this->hasAudio;
    }

    /**
     * @return bool
     */
    public function hasMediaPlayback()
    {
        return $this->hasMediaPlayback;
    }

    /**
     * @return bool
     */
    public function hasWebBrowser()
    {
        return $this->hasWebBrowser;
    }
}
