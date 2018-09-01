<?php

namespace Dialogflow\tests\Action;

use Dialogflow\Action\Responses\LinkOutSuggestion;
use Dialogflow\Action\Responses\Suggestions;
use Dialogflow\WebhookClient;
use PHPUnit\Framework\TestCase;

class SuggestionsTest extends TestCase
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

        $conv->ask('Please choose');
        $conv->ask(new Suggestions(['Suggestion 1', 'Suggestion 2']));
        $conv->ask(new Suggestions('Suggestion 3'));
        $conv->ask(new LinkOutSuggestion('Website', 'http://www.example.com'));

        $this->assertEquals([
            'expectUserResponse' => true,
            'richResponse'       => [
              'items' => [
                0 => [
                  'simpleResponse' => [
                    'textToSpeech' => 'Please choose',
                  ],
                ],
              ],
              'suggestions' => [
                0 => [
                  'title' => 'Suggestion 1',
                ],
                1 => [
                  'title' => 'Suggestion 2',
                ],
                2 => [
                  'title' => 'Suggestion 3',
                ],
              ],
              'linkOutSuggestion' => [
                'destinationName' => 'Website',
                'openUrlAction'   => [
                  'url' => 'http://www.example.com',
                ],
              ],
            ],
          ], $conv->render());
    }
}
