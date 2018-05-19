<?php

namespace Dialogflow\tests\Action;

use Dialogflow\Action\Responses\BasicCard;
use Dialogflow\WebhookClient;
use PHPUnit\Framework\TestCase;

class BasicCardTest extends TestCase
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
            BasicCard::create()
            ->title('This is a card title')
            ->formattedText('This is a body of the card')
            ->image('https://picsum.photos/500/300')
            ->button('Read more', 'https://example.google.com')
        );

        $this->assertEquals([
            'expectUserResponse' => true,
            'richResponse'       => [
                'items' => [
                    [
                        'basicCard' => [
                            'title'         => 'This is a card title',
                            'formattedText' => 'This is a body of the card',
                            'image'         => [
                                'url'               => 'https://picsum.photos/500/300',
                                'accessibilityText' => 'accessibility text',
                            ],
                            'buttons' => [
                                [
                                    'title'         => 'Read more',
                                    'openUrlAction' => [
                                        'url' => 'https://example.google.com',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ], $conv->render());
    }
}
