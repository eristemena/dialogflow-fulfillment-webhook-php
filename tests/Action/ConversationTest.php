<?php

namespace Dialogflow\tests\Action;

use Dialogflow\Action\Conversation;
use Dialogflow\Action\Questions\Confirmation;
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

    private function getGooglePayload($question)
    {
        if ($question == 'CONFIRMATION') {
            $json = '
        {
            "isInSandbox":true,
            "surface":{
                "capabilities":[
                    {
                        "name":"actions.capability.MEDIA_RESPONSE_AUDIO"
                    },
                    {
                        "name":"actions.capability.WEB_BROWSER"
                    },
                    {
                        "name":"actions.capability.AUDIO_OUTPUT"
                    },
                    {
                        "name":"actions.capability.SCREEN_OUTPUT"
                    }
                ]
            },
            "inputs":[
                {
                    "rawInputs":[
                        {
                            "query":"yes",
                            "inputType":"KEYBOARD"
                        }
                    ],
                    "arguments":[
                        {
                            "name":"CONFIRMATION",
                            "boolValue":true
                        }
                    ],
                    "intent":"actions.intent.CONFIRMATION"
                }
            ],
            "user":{
                "userStorage":"{\"data\":{}}",
                "lastSeen":"2018-05-15T22:55:17Z",
                "locale":"en-US",
                "userId":"ABwppHHRq4M6ZiJzBoAwy8GP-avPx07-N8SAWalWejgJDTZpHSj61TlzGgC1yJkQqA6OKsel7bvB-agBZiw"
            },
            "conversation":{
                "conversationId":"1526425023580",
                "type":"ACTIVE",
                "conversationToken":"[]"
            },
            "availableSurfaces":[
                {
                    "capabilities":[
                        {
                            "name":"actions.capability.AUDIO_OUTPUT"
                        },
                        {
                            "name":"actions.capability.SCREEN_OUTPUT"
                        }
                    ]
                }
            ]
        }
            ';
        } else {
            $json = '
        {
            "isInSandbox":true,
            "surface":{
                "capabilities":[
                    {
                        "name":"actions.capability.MEDIA_RESPONSE_AUDIO"
                    },
                    {
                        "name":"actions.capability.WEB_BROWSER"
                    },
                    {
                        "name":"actions.capability.AUDIO_OUTPUT"
                    },
                    {
                        "name":"actions.capability.SCREEN_OUTPUT"
                    }
                ]
            },
            "inputs":[
                {
                    "rawInputs":[
                        {
                            "query":"yes",
                            "inputType":"KEYBOARD"
                        }
                    ],
                    "intent":"actions.intent.CONFIRMATION"
                }
            ],
            "user":{
                "userStorage":"{\"data\":{}}",
                "lastSeen":"2018-05-15T22:55:17Z",
                "locale":"en-US",
                "userId":"ABwppHHRq4M6ZiJzBoAwy8GP-avPx07-N8SAWalWejgJDTZpHSj61TlzGgC1yJkQqA6OKsel7bvB-agBZiw"
            },
            "conversation":{
                "conversationId":"1526425023580",
                "type":"ACTIVE",
                "conversationToken":"[]"
            },
            "availableSurfaces":[
                {
                    "capabilities":[
                        {
                            "name":"actions.capability.AUDIO_OUTPUT"
                        },
                        {
                            "name":"actions.capability.SCREEN_OUTPUT"
                        }
                    ]
                }
            ]
        }
            ';
        }

        return json_decode($json, true);
    }

    private function getConversation()
    {
        $agent = $this->getAgent();

        return $agent->getActionConversation();
    }

    public function testAddResponseMessage()
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

    public function testAddQuestionMessage()
    {
        $conv = $this->getConversation();

        $conv->ask(new Confirmation('Will you marry me?'));

        $this->assertEquals([
            'expectUserResponse' => true,
            'richResponse'       => [
                'items' => [
                    [
                        'simpleResponse' => [
                            'textToSpeech' => 'PLACEHOLDER_FOR_CONFIRMATION',
                        ],
                    ],
                ],
            ],
            'systemIntent' => [
                'intent' => 'actions.intent.CONFIRMATION',
                'data'   => [
                    '@type'      => 'type.googleapis.com/google.actions.v2.ConfirmationValueSpec',
                    'dialogSpec' => [
                        'requestConfirmationText' => 'Will you marry me?',
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

        $availableSurface = $conv->getAvailableSurfaces();

        $this->assertTrue($availableSurface->hasAudio());
        $this->assertTrue($availableSurface->hasScreen());
        $this->assertFalse($availableSurface->hasMediaPlayback());
        $this->assertFalse($availableSurface->hasWebBrowser());
    }

    public function testArgumentNoArgument()
    {
        $payload = $this->getGooglePayload('noargument');

        $conv = new Conversation($payload);

        $arguments = $conv->getArguments();

        $this->assertEquals(null, $arguments);
    }

    public function testArgumentConfirmation()
    {
        $payload = $this->getGooglePayload('CONFIRMATION');

        $conv = new Conversation($payload);

        $arguments = $conv->getArguments();

        $this->assertTrue($arguments->get('CONFIRMATION'));
    }
}
