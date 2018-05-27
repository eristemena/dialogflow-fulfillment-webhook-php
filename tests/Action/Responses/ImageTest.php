<?php

namespace Dialogflow\tests\Action;

use Dialogflow\Action\Responses\Image;
use Dialogflow\WebhookClient;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
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

        $conv->close(
            Image::create('https://picsum.photos/400/300')
        );

        $this->assertEquals([
            'expectUserResponse' => false,
            'richResponse'       => [
                'items' => [
                    [
                        'basicCard' => [
                            'image'         => [
                                'url'               => 'https://picsum.photos/400/300',
                                'accessibilityText' => 'accessibility text',
                            ],
                        ],
                    ],
                ],
            ],
        ], $conv->render());
    }
}
