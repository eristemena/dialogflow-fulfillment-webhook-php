<?php

namespace Dialogflow\tests\RichMessage;

use Dialogflow\RichMessage\Image;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ImageTest extends TestCase
{
    protected static function getMethod($name)
    {
        $class = new ReflectionClass('Dialogflow\RichMessage\Image');
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }

    private function getImageV1Google()
    {
        $image = Image::create('https://picsum.photos/200/300');

        $setAgentVersion = self::getMethod('setAgentVersion');
        $setAgentVersion->invokeArgs($image, [1]);

        $setRequestSource = self::getMethod('setRequestSource');
        $setRequestSource->invokeArgs($image, ['google']);

        return $image;
    }

    private function getImageV1Facebook()
    {
        $image = Image::create('https://picsum.photos/200/300');

        $setAgentVersion = self::getMethod('setAgentVersion');
        $setAgentVersion->invokeArgs($image, [1]);

        $setRequestSource = self::getMethod('setRequestSource');
        $setRequestSource->invokeArgs($image, ['facebook']);

        return $image;
    }

    private function getImageV2Google()
    {
        $image = Image::create('https://picsum.photos/200/300');

        $setAgentVersion = self::getMethod('setAgentVersion');
        $setAgentVersion->invokeArgs($image, [2]);

        $setRequestSource = self::getMethod('setRequestSource');
        $setRequestSource->invokeArgs($image, ['google']);

        return $image;
    }

    private function getImageV2Facebook()
    {
        $image = Image::create('https://picsum.photos/200/300');

        $setAgentVersion = self::getMethod('setAgentVersion');
        $setAgentVersion->invokeArgs($image, [2]);

        $setRequestSource = self::getMethod('setRequestSource');
        $setRequestSource->invokeArgs($image, ['facebook']);

        return $image;
    }

    public function testCreate()
    {
        $image = $this->getImageV1Google();

        $this->assertInstanceOf('\Dialogflow\RichMessage\Image', $image);
    }

    public function testRenderV1Google()
    {
        $image = $this->getImageV1Google();
        $this->assertEquals([
            'type'     => 'basic_card',
            'platform' => 'google',
            'image'    => [
                'url'               => 'https://picsum.photos/200/300',
                'accessibilityText' => 'accessibility text',
            ],
        ], $image->render());
    }

    public function testRenderV2Google()
    {
        $image = $this->getImageV2Google();
        $this->assertEquals([
            'platform'  => 'ACTIONS_ON_GOOGLE',
            'basicCard' => [
                'image' => [
                    'imageUri'          => 'https://picsum.photos/200/300',
                    'accessibilityText' => 'accessibility text',
                ],
            ],
        ], $image->render());
    }

    public function testRenderV1Facebook()
    {
        $image = $this->getImageV1Facebook();
        $this->assertEquals([
            'type'     => 3,
            'imageUrl' => 'https://picsum.photos/200/300',
            'platform' => 'facebook',
        ], $image->render());
    }

    public function testRenderV2Facebook()
    {
        $image = $this->getImageV2Facebook();
        $this->assertEquals([
            'platform' => 'FACEBOOK',
            'image'    => [
                'imageUri' => 'https://picsum.photos/200/300',
            ],
        ], $image->render());
    }
}
