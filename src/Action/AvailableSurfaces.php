<?php

namespace Dialogflow\Action;

class AvailableSurfaces
{
    /** @var array */
    protected $surfaces = [];

    /**
     * @param array $data request array
     */
    public function __construct($data)
    {
        $surfaces = [];
        foreach ($data as $surfaceData) {
            $surfaces[] = new Surface($surfaceData);
        }

        $this->surfaces = $surfaces;
    }

    /**
     * @return bool
     */
    public function hasScreen()
    {
        foreach ($this->surfaces as $surface) {
            if ($surface->hasScreen()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasAudio()
    {
        foreach ($this->surfaces as $surface) {
            if ($surface->hasAudio()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasMediaPlayback()
    {
        foreach ($this->surfaces as $surface) {
            if ($surface->hasMediaPlayback()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasWebBrowser()
    {
        foreach ($this->surfaces as $surface) {
            if ($surface->hasWebBrowser()) {
                return true;
            }
        }

        return false;
    }
}
