<?php

namespace Dialogflow\tests\Action;

use Dialogflow\Action\Questions\DateTime;
use Dialogflow\WebhookClient;
use PHPUnit\Framework\TestCase;

class DateTimeTest extends TestCase
{
    private function getConversation()
    {
        $data = json_decode(file_get_contents(__DIR__.'/../../stubs/request-v2-google.json'), true);

        $agent = new WebhookClient($data);

        return $agent->getActionConversation();
    }

    private function getConversationResponse()
    {
        $data = json_decode(file_get_contents(__DIR__.'/../../stubs/request-v2-google-datetime.json'), true);

        $agent = new WebhookClient($data);

        return $agent->getActionConversation();
    }

    public function testCreate()
    {
        $conv = $this->getConversation();

        $conv->ask(new DateTime('When do you want to come in?', 'What is the best date to schedule your appointment?', 'What time of day works best for you?'));

        $this->assertEquals([
            'expectUserResponse' => true,
            'richResponse'       => [
              'items' => [
                0 => [
                  'simpleResponse' => [
                    'textToSpeech' => 'PLACEHOLDER',
                  ],
                ],
              ],
            ],
            'systemIntent' => [
              'intent' => 'actions.intent.DATETIME',
              'data'   => [
                '@type'      => 'type.googleapis.com/google.actions.v2.DateTimeValueSpec',
                'dialogSpec' => [
                  'requestDatetimeText' => 'When do you want to come in?',
                  'requestDateText'     => 'What is the best date to schedule your appointment?',
                  'requestTimeText'     => 'What time of day works best for you?',
                ],
              ],
            ],
          ], $conv->render());
    }

    public function testResponse()
    {
        $conv = $this->getConversationResponse();

        $date = $conv->getArguments()->get('DATETIME');

        $this->assertInstanceOf('Carbon\Carbon', $date);
    }
}
