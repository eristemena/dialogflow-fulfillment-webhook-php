<?php

namespace Dialogflow\tests\Action;

use Dialogflow\Action\Responses\BrowseCarousel;
use Dialogflow\Action\Responses\BrowseCarousel\Option;
use Dialogflow\WebhookClient;
use PHPUnit\Framework\TestCase;

class BrowseCarouselTest extends TestCase
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
            BrowseCarousel::create()
            ->imageDisplayOptions('CROPPED')
            ->addOption(
                Option::create()
                ->title('Title of item 1')
                ->description('Description of item 1')
                ->footer('Item 1 footer')
                ->url('http://www.example.com')
                ->image('https://picsum.photos/300/300')
            )
            ->addOption(
                Option::create()
                ->title('Title of item 2')
                ->description('Description of item 2')
                ->footer('Item 2 footer')
                ->url('http://www.example.com')
                ->image('https://picsum.photos/300/300')
            )
            ->addOption(
                Option::create()
                ->title('Title of item 3')
                ->description('Description of item 3')
                ->footer('Item 3 footer')
                ->url('http://www.example.com')
                ->image('https://picsum.photos/300/300')
            )
            ->addOption(
                Option::create()
                ->title('Title of item 4')
                ->description('Description of item 4')
                ->footer('Item 4 footer')
                ->url('http://www.example.com')
                ->image('https://picsum.photos/300/300')
            )
        );

        $this->assertEquals([
            'expectUserResponse' => true,
            'richResponse'       => [
              'items' => [
                0 => [
                  'carouselBrowse' => [
                    'imageDisplayOptions' => 'CROPPED',
                    'items'               => [
                      0 => [
                        'title'       => 'Title of item 1',
                        'description' => 'Description of item 1',
                        'footer'      => 'Item 1 footer',
                        'image'       => [
                          'url'               => 'https://picsum.photos/300/300',
                          'accessibilityText' => 'accessibility text',
                        ],
                        'openUrlAction' => [
                          'url' => 'http://www.example.com',
                        ],
                      ],
                      1 => [
                        'title'       => 'Title of item 2',
                        'description' => 'Description of item 2',
                        'footer'      => 'Item 2 footer',
                        'image'       => [
                          'url'               => 'https://picsum.photos/300/300',
                          'accessibilityText' => 'accessibility text',
                        ],
                        'openUrlAction' => [
                          'url' => 'http://www.example.com',
                        ],
                      ],
                      2 => [
                        'title'       => 'Title of item 3',
                        'description' => 'Description of item 3',
                        'footer'      => 'Item 3 footer',
                        'image'       => [
                          'url'               => 'https://picsum.photos/300/300',
                          'accessibilityText' => 'accessibility text',
                        ],
                        'openUrlAction' => [
                          'url' => 'http://www.example.com',
                        ],
                      ],
                      3 => [
                        'title'       => 'Title of item 4',
                        'description' => 'Description of item 4',
                        'footer'      => 'Item 4 footer',
                        'image'       => [
                          'url'               => 'https://picsum.photos/300/300',
                          'accessibilityText' => 'accessibility text',
                        ],
                        'openUrlAction' => [
                          'url' => 'http://www.example.com',
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
