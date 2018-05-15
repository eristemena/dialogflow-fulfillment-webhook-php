<?php

namespace Dialogflow\tests\RichMessage;

use Dialogflow\RichMessage\Card;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class CardTest extends TestCase
{
    protected static function getMethod($name)
    {
        $class = new ReflectionClass('Dialogflow\RichMessage\Card');
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }

    private function getCardV1Google()
    {
        $card = Card::create()
            ->title('This is title')
            ->text('This is text body, you can put whatever here.')
            ->image('https://picsum.photos/200/300')
            ->button('This is a button', 'https://docs.dialogflow.com/');

        $setAgentVersion = self::getMethod('setAgentVersion');
        $setAgentVersion->invokeArgs($card, [1]);

        $setRequestSource = self::getMethod('setRequestSource');
        $setRequestSource->invokeArgs($card, ['google']);

        return $card;
    }

    private function getCardV1Facebook()
    {
        $card = Card::create()
            ->title('This is title')
            ->text('This is text body, you can put whatever here.')
            ->image('https://picsum.photos/200/300')
            ->button('This is a button', 'https://docs.dialogflow.com/');

        $setAgentVersion = self::getMethod('setAgentVersion');
        $setAgentVersion->invokeArgs($card, [1]);

        $setRequestSource = self::getMethod('setRequestSource');
        $setRequestSource->invokeArgs($card, ['facebook']);

        return $card;
    }

    private function getCardV2Google()
    {
        $card = Card::create()
            ->title('This is title')
            ->text('This is text body, you can put whatever here.')
            ->image('https://picsum.photos/200/300')
            ->button('This is a button', 'https://docs.dialogflow.com/');

        $setAgentVersion = self::getMethod('setAgentVersion');
        $setAgentVersion->invokeArgs($card, [2]);

        $setRequestSource = self::getMethod('setRequestSource');
        $setRequestSource->invokeArgs($card, ['google']);

        return $card;
    }

    private function getCardV2Facebook()
    {
        $card = Card::create()
            ->title('This is title')
            ->text('This is text body, you can put whatever here.')
            ->image('https://picsum.photos/200/300')
            ->button('This is a button', 'https://docs.dialogflow.com/');

        $setAgentVersion = self::getMethod('setAgentVersion');
        $setAgentVersion->invokeArgs($card, [2]);

        $setRequestSource = self::getMethod('setRequestSource');
        $setRequestSource->invokeArgs($card, ['facebook']);

        return $card;
    }

    public function testCreate()
    {
        $card = $this->getCardV1Google();

        $this->assertInstanceOf('\Dialogflow\RichMessage\Card', $card);
    }

    public function testRenderV1Google()
    {
        $card = $this->getCardV1Google();
        $this->assertEquals([
            'type'          => 'basic_card',
            'platform'      => 'google',
            'title'         => 'This is title',
            'formattedText' => 'This is text body, you can put whatever here.',
            'image'         => [
                'url'               => 'https://picsum.photos/200/300',
                'accessibilityText' => 'accessibility text',
            ],
            'buttons' => [
                [
                    'title'         => 'This is a button',
                    'openUrlAction' => [
                        'url' => 'https://docs.dialogflow.com/',
                    ],
                ],
            ],
        ], $card->render());
    }

    public function testRenderV2Google()
    {
        $card2 = $this->getCardV2Google();
        $this->assertEquals([
            'platform'  => 'ACTIONS_ON_GOOGLE',
            'basicCard' => [
                'title'         => 'This is title',
                'formattedText' => 'This is text body, you can put whatever here.',
                'image'         => [
                    'imageUri'          => 'https://picsum.photos/200/300',
                    'accessibilityText' => 'accessibility text',
                ],
                'buttons' => [
                    [
                        'title'         => 'This is a button',
                        'openUriAction' => [
                            'uri' => 'https://docs.dialogflow.com/',
                        ],
                    ],
                ],
            ],
        ], $card2->render());
    }

    public function testRenderV1Facebook()
    {
        $card3 = $this->getCardV1Facebook();
        $this->assertEquals([
            'type'     => 1,
            'title'    => 'This is title',
            'subtitle' => 'This is text body, you can put whatever here.',
            'imageUrl' => 'https://picsum.photos/200/300',
            'buttons'  => [
                [
                    'text'     => 'This is a button',
                    'postback' => 'https://docs.dialogflow.com/',
                ],
            ],
            'platform' => 'facebook',
        ], $card3->render());
    }

    public function testRenderV2Facebook()
    {
        $card4 = $this->getCardV2Facebook();
        $this->assertEquals([
            'platform' => 'FACEBOOK',
            'card'     => [
                'title'    => 'This is title',
                'subtitle' => 'This is text body, you can put whatever here.',
                'imageUri' => 'https://picsum.photos/200/300',
                'buttons'  => [
                    [
                        'text'     => 'This is a button',
                        'postback' => 'https://docs.dialogflow.com/',
                    ],
                ],
            ],
        ], $card4->render());
    }
}
