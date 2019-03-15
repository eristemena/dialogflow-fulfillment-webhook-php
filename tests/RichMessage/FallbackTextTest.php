<?php

namespace Dialogflow\tests\RichMessage;

use Dialogflow\RichMessage\Card;
use Dialogflow\WebhookClient;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class FallbackTextTest extends TestCase
{
    private $fallbackText = 'This is fallback text';

    protected static function getMethod($name)
    {
        $class = new ReflectionClass('Dialogflow\RichMessage\Card');
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }

    private function getCard(){
        $Card = Card::create();
        return $Card;
    }
    private function getClient()
    {
        $request = [
            "responseId"  => "123",
            "queryResult" => [
                "queryText"                => "fubar",
                "parameters"               =>[],
                "allRequiredParamsPresent" => true,
                "fulfillmentText"          => "fubar",
                "fulfillmentMessages"      => [
                    "text" => [
                        "text" => [
                            "Fubar"
                        ]
                    ]
                ],
                "intent" => [
                    "name"        => "projects/blah/agent/intents/blah",
                    "displayName" => "Blah"
                ],
                "intentDetectionConfidence"   => 1,
                "languageCode"                => "en"
            ],
            "originalDetectIntentRequest" => [
                "payload" => []
            ],
            "session" => "projects/blah/agent/sessions/blah",
            "alternativeQueryResults" => [
                [
                    "queryText"    => "Blah",
                    "languageCode" => "en"
                ]
            ]
        ];


        $Client = new WebhookClient($request);

        $setAgentVersion = self::getMethod('setAgentVersion');
        $setAgentVersion->invokeArgs($Client, [2]);

        $setRequestSource = self::getMethod('setRequestSource');
        $setRequestSource->invokeArgs($Client, ['unspecified']);

        return $Client;
    }


    /**
     * Test that the setFallbackText() method actually sets the value
     */
    public function testSetFallbackText()
    {
        $Card = $this->getCard();
        $Card->setFallbackText($this->fallbackText);
        $this->assertEquals($this->fallbackText,$Card->getFallbackText());
    }

    /**
     * Test that the fallbackText() method actually sets the value
     */
    public function testFallbackText()
    {
        $Card = $this->getCard();
        $Card->fallbackText($this->fallbackText);
        $this->assertEquals($this->fallbackText,$Card->getFallbackText());
    }

    /**
     * Test that WebhookClient actually falls back to the fallback text,
     * when the source doesn't support rich messages
     */
    public function testReplyFallback(){
        $Client  = $this->getClient();
        $Card    = $this->getCard();
        $Card->fallbackText($this->fallbackText);
        $Message = $Client->reply($Card);

        $this->assertAttributeEquals($this->fallbackText,'text',$Message);
    }
}
