<?php

namespace Dialogflow\tests\Action;

use Dialogflow\Action\Questions\Carousel;
use Dialogflow\Action\Questions\Carousel\Option;
use Dialogflow\WebhookClient;
use PHPUnit\Framework\TestCase;

class CarouselTest extends TestCase
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

        $conv->ask('Please choose below');

        $conv->ask(Carousel::create()
            ->imageDisplayOptions('WHITE')
            ->addOption(Option::create()
                ->key('OPTION_1')
                ->title('Option 1')
                ->synonyms(['option one', 'one'])
                ->description('Select option 1')
                ->image('https://picsum.photos/300/300')
            )
            ->addOption(Option::create()
                ->key('OPTION_2')
                ->title('Option 2')
                ->synonyms(['option two', 'two'])
                ->description('Select option 2')
                ->image('https://picsum.photos/300/300')
            )
        );

        $this->assertEquals([
            'expectUserResponse' => true,
            'richResponse'       => [
              'items' => [
                0 => [
                  'simpleResponse' => [
                    'textToSpeech' => 'Please choose below',
                  ],
                ],
              ],
            ],
            'systemIntent' => [
              'intent' => 'actions.intent.OPTION',
              'data'   => [
                '@type'          => 'type.googleapis.com/google.actions.v2.OptionValueSpec',
                'carouselSelect' => [
                  'imageDisplayOptions' => 'WHITE',
                  'items'               => [
                    0 => [
                      'optionInfo' => [
                        'key'      => 'OPTION_1',
                        'synonyms' => [
                          0 => 'option one',
                          1 => 'one',
                        ],
                      ],
                      'title'       => 'Option 1',
                      'description' => 'Select option 1',
                      'image'       => [
                        'url'               => 'https://picsum.photos/300/300',
                        'accessibilityText' => 'accessibility text',
                      ],
                    ],
                    1 => [
                      'optionInfo' => [
                        'key'      => 'OPTION_2',
                        'synonyms' => [
                          0 => 'option two',
                          1 => 'two',
                        ],
                      ],
                      'title'       => 'Option 2',
                      'description' => 'Select option 2',
                      'image'       => [
                        'url'               => 'https://picsum.photos/300/300',
                        'accessibilityText' => 'accessibility text',
                      ],
                    ],
                  ],
                ],
              ],
            ],
          ], $conv->render());
    }
}
