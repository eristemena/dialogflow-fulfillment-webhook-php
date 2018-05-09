<?php

namespace Dialogflow\tests;

use RuntimeException;

use PHPUnit\Framework\TestCase;
use Dialogflow\WebhookClient;

class WebhookClientTest extends TestCase
{
    protected $request;
    protected $request2;
    protected $requestv1web;

    protected function setUp()
    {
        $data_v1 = json_decode(file_get_contents(__DIR__ . '/stubs/request-v1-google.json'), true);
        $this->request = new WebhookClient($data_v1);

        $data_v1_eb = json_decode(file_get_contents(__DIR__ . '/stubs/request-v1-web.json'), true);
        $this->requestv1web = new WebhookClient($data_v1_eb);

        $data_v2 = json_decode(file_get_contents(__DIR__ . '/stubs/request-v2-facebook.json'), true);
        $this->request2 = new WebhookClient($data_v2);
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('\Dialogflow\WebhookClient', $this->request);
    }

    /**
     * @expectedException RuntimeException
     */
    public function testException()
    {
        $request = new WebhookClient([]);
    }

    public function testAgentVersion()
    {
        $this->assertEquals(1, $this->request->getAgentVersion());
        $this->assertEquals(1, $this->requestv1web->getAgentVersion());
        $this->assertEquals(2, $this->request2->getAgentVersion());
    }

    public function testIntent()
    {
        $this->assertEquals('prayer.time', $this->request->getIntent());
    }

    public function testAction()
    {
        $this->assertEquals('prayer.time', $this->request->getAction());
    }

    public function testSession()
    {
        $this->assertEquals('1525478176609', $this->request->getSession());
    }

    public function testParameters()
    {
        $expectedParameters = [
            'date' => null,
            'kota' => '1470',
            'propinsi' => null,
            'shalat' => 'isha'
        ];

        $this->assertEquals($expectedParameters, $this->request->getParameters());
    }

    public function testContexts()
    {
        $contexts = $this->request->getContexts();

        $this->assertInternalType('array', $contexts);

        if(count($contexts)>0){
            $context = $contexts[0];

            $this->assertInstanceOf('\Dialogflow\Context', $context);

            $this->assertEquals('google_assistant_welcome', $context->getName());
            $this->assertEquals(0, $context->getLifespan());

            $expectedParameters = [
                "date" => null,
                "propinsi" => null,
                "kota.original" => "jakarta utara",
                "kota" => "1470",
                "shalat.original" => "isya",
                "date.original" => null,
                "shalat" => "isha",
                "propinsi.original" => null
            ];

            $this->assertEquals($expectedParameters, $context->getParameters());
        }
    }

    public function testRequestSource()
    {
        $this->assertEquals('google', $this->request->getRequestSource());
        $this->assertEquals('agent', $this->requestv1web->getRequestSource());
    }

    public function testOriginalRequest()
    {
        $originalRequest = $this->request->getOriginalRequest();

        $this->assertInternalType('array', $originalRequest);
    }

    public function testQuery()
    {
        $this->assertEquals('kapan waktu shalat isya di jakarta utara', $this->request->getQuery());
    }

    public function testLocale()
    {
        $this->assertEquals('id', $this->request->getLocale());
    }
}