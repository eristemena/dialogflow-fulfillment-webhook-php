<?php

namespace Dialogflow\tests\Action;

use Dialogflow\Action\Responses\MediaObject;
use Dialogflow\Action\Responses\MediaResponse;
use Dialogflow\Action\Responses\Suggestions;
use Dialogflow\WebhookClient;
use PHPUnit\Framework\TestCase;

class MediaResponseTest extends TestCase
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

        $conv->ask('Here you go');
        $conv->ask(
            MediaResponse::create(
                MediaObject::create('http://storage.googleapis.com/automotive-media/Jazz_In_Paris.mp3')
                ->name('Jazz in Paris')
                ->description('A funky Jazz tune')
                ->icon('http://storage.googleapis.com/automotive-media/album_art.jpg')
                ->image('http://storage.googleapis.com/automotive-media/album_art.jpg')
            )
        );
        $conv->ask(new Suggestions(['Pause', 'Stop', 'Start over']));

        $this->assertEquals([
            'expectUserResponse' => true,
            'richResponse'       => [
              'items' => [
                0 => [
                  'simpleResponse' => [
                    'textToSpeech' => 'Here you go',
                  ],
                ],
                1 => [
                  'mediaResponse' => [
                    'mediaType'    => 'AUDIO',
                    'mediaObjects' => [
                      0 => [
                        'contentUrl'  => 'http://storage.googleapis.com/automotive-media/Jazz_In_Paris.mp3',
                        'name'        => 'Jazz in Paris',
                        'description' => 'A funky Jazz tune',
                        'icon'        => [
                          'url' => 'http://storage.googleapis.com/automotive-media/album_art.jpg',
                        ],
                        'largeImage' => [
                          'url' => 'http://storage.googleapis.com/automotive-media/album_art.jpg',
                        ],
                      ],
                    ],
                  ],
                ],
              ],
              'suggestions' => [
                0 => [
                  'title' => 'Pause',
                ],
                1 => [
                  'title' => 'Stop',
                ],
                2 => [
                  'title' => 'Start over',
                ],
              ],
            ],
          ], $conv->render());
    }

    public function testCreateMultipleMediaObjects()
    {
        $conv = $this->getConversation();

        $conv->ask('Here you go');
        $conv->ask(
            MediaResponse::create()
            ->add(
                MediaObject::create('http://storage.googleapis.com/automotive-media/Jazz_In_Paris.mp3')
                ->name('Jazz in Paris')
                ->description('A funky Jazz tune')
                ->icon('http://storage.googleapis.com/automotive-media/album_art.jpg')
                ->image('http://storage.googleapis.com/automotive-media/album_art.jpg')
            )
            ->add(
                MediaObject::create('http://storage.googleapis.com/automotive-media/Jazz_In_Paris.mp3')
                ->name('Jazz in Paris')
                ->description('A funky Jazz tune')
                ->icon('http://storage.googleapis.com/automotive-media/album_art.jpg')
                ->image('http://storage.googleapis.com/automotive-media/album_art.jpg')
            )
        );
        $conv->ask(new Suggestions(['Pause', 'Stop', 'Start over']));

        $this->assertEquals([
            'expectUserResponse' => true,
            'richResponse'       => [
              'items' => [
                0 => [
                  'simpleResponse' => [
                    'textToSpeech' => 'Here you go',
                  ],
                ],
                1 => [
                  'mediaResponse' => [
                    'mediaType'    => 'AUDIO',
                    'mediaObjects' => [
                      0 => [
                        'contentUrl'  => 'http://storage.googleapis.com/automotive-media/Jazz_In_Paris.mp3',
                        'name'        => 'Jazz in Paris',
                        'description' => 'A funky Jazz tune',
                        'icon'        => [
                          'url' => 'http://storage.googleapis.com/automotive-media/album_art.jpg',
                        ],
                        'largeImage' => [
                          'url' => 'http://storage.googleapis.com/automotive-media/album_art.jpg',
                        ],
                      ],
                      1 => [
                        'contentUrl'  => 'http://storage.googleapis.com/automotive-media/Jazz_In_Paris.mp3',
                        'name'        => 'Jazz in Paris',
                        'description' => 'A funky Jazz tune',
                        'icon'        => [
                          'url' => 'http://storage.googleapis.com/automotive-media/album_art.jpg',
                        ],
                        'largeImage' => [
                          'url' => 'http://storage.googleapis.com/automotive-media/album_art.jpg',
                        ],
                      ],
                    ],
                  ],
                ],
              ],
              'suggestions' => [
                0 => [
                  'title' => 'Pause',
                ],
                1 => [
                  'title' => 'Stop',
                ],
                2 => [
                  'title' => 'Start over',
                ],
              ],
            ],
          ], $conv->render());
    }
}
