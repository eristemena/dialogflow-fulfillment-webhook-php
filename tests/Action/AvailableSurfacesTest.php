<?php

namespace Dialogflow\tests\Action;

use Dialogflow\Action\AvailableSurfaces;
use PHPUnit\Framework\TestCase;

class AvailableSurfacesTest extends TestCase
{
    public function testDoesNotHaveScreen()
    {
        $availableSurfaces = new AvailableSurfaces([
            [
                'capabilities' => [
                    [
                        'name' => 'actions.capability.AUDIO_OUTPUT',
                    ],
                ],
            ],
        ]);

        $this->assertTrue($availableSurfaces->hasAudio());
        $this->assertFalse($availableSurfaces->hasScreen());
        $this->assertFalse($availableSurfaces->hasMediaPlayback());
        $this->assertFalse($availableSurfaces->hasWebBrowser());
    }

    public function testDoesNotHaveAudio()
    {
        $availableSurfaces = new AvailableSurfaces([
            [
                'capabilities' => [
                    [
                        'name' => 'actions.capability.SCREEN_OUTPUT',
                    ],
                ],
            ],
        ]);

        $this->assertFalse($availableSurfaces->hasAudio());
        $this->assertTrue($availableSurfaces->hasScreen());
        $this->assertFalse($availableSurfaces->hasMediaPlayback());
        $this->assertFalse($availableSurfaces->hasWebBrowser());
    }

    public function testHasMediaPlayback()
    {
        $availableSurfaces = new AvailableSurfaces([
            [
                'capabilities' => [
                    [
                        'name' => 'actions.capability.MEDIA_RESPONSE_AUDIO',
                    ],
                ],
            ],
        ]);

        $this->assertFalse($availableSurfaces->hasAudio());
        $this->assertFalse($availableSurfaces->hasScreen());
        $this->assertTrue($availableSurfaces->hasMediaPlayback());
        $this->assertFalse($availableSurfaces->hasWebBrowser());
    }

    public function testHasWebBrowser()
    {
        $availableSurfaces = new AvailableSurfaces([
            [
                'capabilities' => [
                    [
                        'name' => 'actions.capability.WEB_BROWSER',
                    ],
                ],
            ],
        ]);

        $this->assertFalse($availableSurfaces->hasAudio());
        $this->assertFalse($availableSurfaces->hasScreen());
        $this->assertFalse($availableSurfaces->hasMediaPlayback());
        $this->assertTrue($availableSurfaces->hasWebBrowser());
    }
}
