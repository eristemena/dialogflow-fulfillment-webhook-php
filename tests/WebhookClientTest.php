<?php

namespace Dialogflow\tests;

use Dialogflow\Context;
use Dialogflow\WebhookClient;
use PHPUnit\Framework\TestCase;

class WebhookClientTest extends TestCase
{
    protected $agentv1google;
    protected $agentv1facebook;
    protected $agentv1web;
    protected $agentv2google;
    protected $agentv2facebook;
    protected $agentv2web;

    protected function setUp()
    {
        $data_v1_google = json_decode(file_get_contents(__DIR__.'/stubs/request-v1-google.json'), true);
        $this->agentv1google = new WebhookClient($data_v1_google);

        $data_v1_facebook = json_decode(file_get_contents(__DIR__.'/stubs/request-v1-facebook.json'), true);
        $this->agentv1facebook = new WebhookClient($data_v1_facebook);

        $data_v1_web = json_decode(file_get_contents(__DIR__.'/stubs/request-v1-web.json'), true);
        $this->agentv1web = new WebhookClient($data_v1_web);

        $data_v2_google = json_decode(file_get_contents(__DIR__.'/stubs/request-v2-google.json'), true);
        $this->agentv2google = new WebhookClient($data_v2_google);

        $data_v2_facebook = json_decode(file_get_contents(__DIR__.'/stubs/request-v2-facebook.json'), true);
        $this->agentv2facebook = new WebhookClient($data_v2_facebook);
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('\Dialogflow\WebhookClient', $this->agentv1google);
    }

    public function testFromData()
    {
        $data_v1_google = json_decode(file_get_contents(__DIR__.'/stubs/request-v1-google.json'), true);
        $this->assertInstanceOf('\Dialogflow\WebhookClient', WebhookClient::fromData($data_v1_google));
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testException()
    {
        $request = new WebhookClient([]);
    }

    public function testAgentVersion()
    {
        $this->assertEquals(1, $this->agentv1google->getAgentVersion());
        $this->assertEquals(1, $this->agentv1facebook->getAgentVersion());
        $this->assertEquals(1, $this->agentv1web->getAgentVersion());
        $this->assertEquals(2, $this->agentv2facebook->getAgentVersion());
        $this->assertEquals(2, $this->agentv2google->getAgentVersion());
    }

    public function testIntent()
    {
        $this->assertEquals('prayer.time', $this->agentv1google->getIntent());
    }

    public function testAction()
    {
        $this->assertEquals('prayer.time', $this->agentv1google->getAction());
    }

    public function testSession()
    {
        $this->assertEquals('1525478176609', $this->agentv1google->getSession());
    }

    public function testParameters()
    {
        $expectedParameters = [
            'date'     => null,
            'kota'     => '1470',
            'propinsi' => null,
            'shalat'   => 'isha',
        ];

        $this->assertEquals($expectedParameters, $this->agentv1google->getParameters());
    }

    public function testContexts()
    {
        $contexts = $this->agentv1google->getContexts();

        $this->assertInternalType('array', $contexts);

        if (count($contexts) > 0) {
            $context = $contexts[0];

            $this->assertInstanceOf('\Dialogflow\Context', $context);

            $this->assertEquals('google_assistant_welcome', $context->getName());
            $this->assertEquals(0, $context->getLifespan());

            $expectedParameters = [
                'date'              => null,
                'propinsi'          => null,
                'kota.original'     => 'jakarta utara',
                'kota'              => '1470',
                'shalat.original'   => 'isya',
                'date.original'     => null,
                'shalat'            => 'isha',
                'propinsi.original' => null,
            ];

            $this->assertEquals($expectedParameters, $context->getParameters());
        }
    }

    public function testContext()
    {
        $weatherContext = $this->agentv2google->getContext('weather');
        $nullContext = $this->agentv2google->getContext('null');

        $this->assertInstanceOf('\Dialogflow\Context', $weatherContext);
        $this->assertEquals(null, $nullContext);
    }

    public function testRequestSource()
    {
        $this->assertEquals('google', $this->agentv1google->getRequestSource());
        $this->assertEquals('agent', $this->agentv1web->getRequestSource());
    }

    public function testOriginalRequest()
    {
        $originalRequest = $this->agentv1google->getOriginalRequest();

        $this->assertInternalType('array', $originalRequest);
    }

    public function testQuery()
    {
        $this->assertEquals('kapan waktu shalat isya di jakarta utara', $this->agentv1google->getQuery());
    }

    public function testLocale()
    {
        $this->assertEquals('id', $this->agentv1google->getLocale());
    }

    public function testReplyV1GoogleSimple()
    {
        $this->agentv1google->reply('Welcome');

        $this->assertEquals([
            'messages' => [
                [
                    'type'         => 'simple_response',
                    'platform'     => 'google',
                    'textToSpeech' => 'Welcome',
                    'displayText'  => 'Welcome',
                ],
            ],
            'contextOut' => [],
        ], $this->agentv1google->render());
    }

    public function testReplyV2GoogleSimple()
    {
        $this->agentv2google->reply('Welcome');

        $this->assertEquals([
            'fulfillmentMessages' => [
                [
                    'platform'        => 'ACTIONS_ON_GOOGLE',
                    'simpleResponses' => [
                        'simpleResponses' => [
                            [
                                'textToSpeech' => 'Welcome',
                                'displayText'  => 'Welcome',
                            ],
                        ],
                    ],
                ],
            ],
            'outputContexts' => [],
        ], $this->agentv2google->render());
    }

    public function testReplyV1FacebookSimple()
    {
        $this->agentv1facebook->reply('Welcome');

        $this->assertEquals([
            'messages' => [
                [
                    'type'     => 0,
                    'platform' => 'facebook',
                    'speech'   => 'Welcome',
                ],
            ],
            'contextOut' => [],
        ], $this->agentv1facebook->render());
    }

    public function testReplyV2FacebookSimple()
    {
        $this->agentv2facebook->reply('Welcome');

        $this->assertEquals([
            'fulfillmentMessages' => [
                [
                    'text' => [
                        'text' => [
                            'Welcome',
                        ],
                    ],
                    'platform' => 'FACEBOOK',
                ],
            ],
            'outputContexts' => [],
        ], $this->agentv2facebook->render());
    }

    public function testReplyV1WebSimple()
    {
        $this->agentv1web->reply('Welcome');

        $this->assertEquals([
            'messages' => [
                [
                    'type'   => 0,
                    'speech' => 'Welcome',
                ],
            ],
            'speech'     => 'Welcome',
            'contextOut' => [],
        ], $this->agentv1web->render());
    }

    public function testReplyV1GoogleText()
    {
        $text = \Dialogflow\RichMessage\Text::create()
            ->text('Welcome')
            ->ssml('Hi, welcome');

        $this->agentv1google->reply($text);

        $array = $this->agentv1google->render();
        $expectedArray = [
            'messages' => [
                [
                    'type'         => 'simple_response',
                    'platform'     => 'google',
                    'textToSpeech' => 'Welcome',
                    'displayText'  => 'Welcome',
                ],
            ],
            'contextOut' => [],
        ];

        $this->assertEquals($expectedArray, $array);
    }

    public function testReplyV2GoogleText()
    {
        $text = \Dialogflow\RichMessage\Text::create()
            ->text('Welcome')
            ->ssml('Hi, welcome');

        $this->agentv2google->reply($text);

        $this->assertEquals([
            'fulfillmentMessages' => [
                [
                    'platform'        => 'ACTIONS_ON_GOOGLE',
                    'simpleResponses' => [
                        'simpleResponses' => [
                            [
                                'ssml'        => 'Hi, welcome',
                                'displayText' => 'Welcome',
                            ],
                        ],
                    ],
                ],
            ],
            'outputContexts' => [],
        ], $this->agentv2google->render());
    }

    public function testNonActionConversation()
    {
        $this->assertEquals(null, $this->agentv2facebook->getActionConversation());
    }

    public function testAskActionConversation()
    {
        $conv = $this->agentv2google->getActionConversation();
        $conv->ask('How are you?');

        $this->assertEquals([
            'expectUserResponse' => true,
            'richResponse'       => [
                'items' => [
                    [
                        'simpleResponse' => [
                            'textToSpeech' => 'How are you?',
                        ],
                    ],
                ],
            ],
        ], $conv->render());

        $this->agentv2google->reply($conv);
        $this->assertEquals([
            'payload' => [
                'google' => [
                    'expectUserResponse' => true,
                    'richResponse'       => [
                        'items' => [
                            [
                                'simpleResponse' => [
                                    'textToSpeech' => 'How are you?',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'outputContexts' => [],
        ], $this->agentv2google->render());
    }

    public function testCloseActionConversation()
    {
        $conv = $this->agentv2google->getActionConversation();
        $conv->close('Thank you');

        $this->assertEquals([
            'expectUserResponse' => false,
            'richResponse'       => [
                'items' => [
                    [
                        'simpleResponse' => [
                            'textToSpeech' => 'Thank you',
                        ],
                    ],
                ],
            ],
        ], $conv->render());
    }

    public function testGetOutgoingContexts()
    {
        $contexts = $this->agentv2google->getOutgoingContexts();

        $this->assertEquals([], $contexts);
    }

    public function testOutgoingContexts()
    {
        $this->agentv2google->setOutgoingContext(new Context('context1', 2, ['param1' => 10]));
        $this->agentv2google->setOutgoingContext('context2');
        $this->agentv2google->setOutgoingContext([
                'name'       => 'context3',
                'lifespan'   => 3,
                'parameters' => ['param1' => 10],
        ]);

        $context1 = $this->agentv2google->getOutgoingContext('context1');
        $context2 = $this->agentv2google->getOutgoingContext('context2');
        $context3 = $this->agentv2google->getOutgoingContext('context3');
        $context4 = $this->agentv2google->getOutgoingContext('context4');

        $this->assertEquals('context1', $context1->getName());
        $this->assertEquals(2, $context1->getLifespan());
        $this->assertEquals(10, $context1->getParameters()['param1']);

        $this->assertEquals('context2', $context2->getName());
        $this->assertEquals(null, $context2->getLifespan());
        $this->assertEquals(null, $context2->getParameters()['param1']);

        $this->assertEquals('context3', $context3->getName());
        $this->assertEquals(3, $context3->getLifespan());
        $this->assertEquals(10, $context3->getParameters()['param1']);

        $this->assertEquals(null, $context4);

        $this->agentv2google->clearOutgoingContext('context1');
        $this->assertEquals(null, $this->agentv2google->getOutgoingContext('context1'));

        $this->agentv2google->clearOutgoingContexts();
        $this->assertEquals([], $this->agentv2google->getOutgoingContexts());

        $this->agentv2google->setOutgoingContexts([new Context('context5')]);
        $this->assertEquals(1, count($this->agentv2google->getOutgoingContexts()));
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testSetOutgoingContextsExceptionEmptyName()
    {
        $this->agentv2google->setOutgoingContext([]);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testSetOutgoingContextsExceptionInvalidParam()
    {
        $this->agentv2google->setOutgoingContext(0);
    }
}
