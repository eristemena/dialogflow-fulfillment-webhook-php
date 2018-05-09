<?php

namespace Dialogflow\tests;

use PHPUnit\Framework\TestCase;
use Dialogflow\WebhookClient;

class WebhookClientTest extends TestCase
{
    protected $request;

    protected function setUp()
    {
        $data = json_decode(file_get_contents(__DIR__ . '/stubs/request-v1.json'), true);
        $this->request = new WebhookClient($data);
    }

    public function it_can_be_created()
    {
        $this->assertInstanceOf(WebhookClient::class, $this->request);
    }

    /**
     * @covers Dialogflow\WebhookClient::getAgentVersion
     */
    public function testAgentVersion()
    {
        $this->assertEquals(1, $this->request->getAgentVersion());
    }

    /**
     * @covers Dialogflow\WebhookClient::getIntent
     */
    public function testIntent()
    {
        $this->assertEquals('currency.convert', $this->request->getIntent());
    }

    /**
     * @covers Dialogflow\WebhookClient::getAction
     */
    public function testAction()
    {
        $this->assertEquals('currency.convert', $this->request->getAction());
    }

    /**
     * @covers Dialogflow\WebhookClient::getSession
     */
    public function testSession()
    {
        $this->assertEquals('48f19ceb-4c15-4046-8f8a-33612b651ec1', $this->request->getSession());
    }
}