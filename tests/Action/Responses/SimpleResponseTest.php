<?php

namespace Dialogflow\tests\Action;

use Dialogflow\Action\Responses\SimpleResponse;
use Dialogflow\WebhookClient;
use PHPUnit\Framework\TestCase;

class SimpleResponseTest extends TestCase
{
    private function getConversation()
    {
        $data = json_decode(file_get_contents(__DIR__.'/../../stubs/request-v2-google.json'), true);

        $agent = new WebhookClient($data);

        return $agent->getActionConversation();
    }

    public function testCreate()
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

    public function testCreateWithOptions()
    {
        $conv = $this->getConversation();

        $conv->ask(
            new SimpleResponse([
                'displayText'  => 'Display text',
                'ssml'         => '<speak>ssml here</speak>',
                'textToSpeech' => 'Text to speech',
            ])
        );

        $this->assertEquals([
            'expectUserResponse' => true,
            'richResponse'       => [
                'items' => [
                    [
                        'simpleResponse' => [
                            'ssml'         => '<speak>ssml here</speak>',
                            'displayText'  => 'Display text',
                            'textToSpeech' => 'Text to speech',
                        ],
                    ],
                ],
            ],
        ], $conv->render());
    }

    public function testTextToSpeech()
    {
        $conv = $this->getConversation();

        $conv->ask(
            SimpleResponse::create()
            ->displayText('Display text')
            ->textToSpeech('Text to speech')
        );

        $this->assertEquals([
            'expectUserResponse' => true,
            'richResponse'       => [
                'items' => [
                    [
                        'simpleResponse' => [
                            'textToSpeech' => 'Text to speech',
                            'displayText'  => 'Display text',
                        ],
                    ],
                ],
            ],
        ], $conv->render());
    }
}
