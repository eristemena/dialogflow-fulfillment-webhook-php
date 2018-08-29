<?php

namespace Dialogflow\tests\Action;

use Dialogflow\Action\Questions\Place;
use Dialogflow\WebhookClient;
use PHPUnit\Framework\TestCase;

class PlaceTest extends TestCase
{
    private function getConversation()
    {
        $data = json_decode(file_get_contents(__DIR__.'/../../stubs/request-v2-google.json'), true);

        $agent = new WebhookClient($data);

        return $agent->getActionConversation();
    }

    private function getConversationResponse()
    {
        $data = json_decode(file_get_contents(__DIR__.'/../../stubs/request-v2-google-place.json'), true);

        $agent = new WebhookClient($data);

        return $agent->getActionConversation();
    }

    public function testCreate()
    {
        $conv = $this->getConversation();

        $conv->ask(new Place('Where do you want to have lunch?', 'To find lunch locations'));

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
              'intent' => 'actions.intent.PLACE',
              'data'   => [
                '@type'      => 'type.googleapis.com/google.actions.v2.PlaceValueSpec',
                'dialogSpec' => [
                  'extension' => [
                    '@type'             => 'type.googleapis.com/google.actions.v2.PlaceValueSpec.PlaceDialogSpec',
                    'requestPrompt'     => 'Where do you want to have lunch?',
                    'permissionContext' => 'To find lunch locations',
                  ],
                ],
              ],
            ],
          ], $conv->render());
    }

    public function testResponse()
    {
        $conv = $this->getConversationResponse();

        $location = $conv->getArguments()->get('PLACE');

        $this->assertInstanceOf('Dialogflow\Action\Types\Location', $location);

        $this->assertEquals('Mountain View', $location->getName());
    }
}
