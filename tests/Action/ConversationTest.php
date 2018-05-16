<?php

namespace Dialogflow\tests\Action;

use Dialogflow\Action\Responses\SimpleResponse;
use Dialogflow\WebhookClient;
use PHPUnit\Framework\TestCase;

class ConversationTest extends TestCase
{
    private function getAgent($type = 'google')
    {
        if ($type == 'facebook') {
            $data = json_decode(file_get_contents(__DIR__.'/../stubs/request-v2-facebook.json'), true);
        } else {
            $data = json_decode(file_get_contents(__DIR__.'/../stubs/request-v2-google.json'), true);
        }

        return new WebhookClient($data);
    }

    private function getConversation()
    {
        $agent = $this->getAgent();

        return $agent->getActionConversation();
    }

    public function testAddMessage()
    {
        $conv = $this->getConversation();

        $conv->ask(
            SimpleResponse::create()
            ->displayText('Display text')
            ->ssml('<speak>ssml here</speak>')
        );

        $this->assertEquals([
            'expectUserResponse' => true,
            'richResponse'       => [
                'items' => [
                    [
                        'simpleResponse' => [
                            'ssml'        => '<speak>ssml here</speak>',
                            'displayText' => 'Display text',
                        ],
                    ],
                ],
            ],
        ], $conv->render());
    }

    public function testSurface()
    {
        $conv = $this->getConversation();

        $surface = $conv->getSurface();

        $this->assertTrue($surface->hasAudio());
        $this->assertTrue($surface->hasScreen());
        $this->assertTrue($surface->hasMediaPlayback());
        $this->assertTrue($surface->hasWebBrowser());
    }

    public function testAvailableSurface()
    {
        $conv = $this->getConversation();

        $availableSurface = $conv->getAvailableSurface();

        $this->assertTrue($availableSurface->hasAudio());
        $this->assertTrue($availableSurface->hasScreen());
        $this->assertFalse($availableSurface->hasMediaPlayback());
        $this->assertFalse($availableSurface->hasWebBrowser());
    }
}
