<?php

namespace Dialogflow\tests\RichMessage;

use Dialogflow\RichMessage\Suggestion;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class SuggestionTest extends TestCase
{
    protected static function getMethod($name)
    {
        $class = new ReflectionClass('Dialogflow\RichMessage\Suggestion');
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }

    private function getSuggestionV1Google()
    {
        $suggestion = Suggestion::create(['Quick Reply 1', 'Quick Reply 2']);

        $setAgentVersion = self::getMethod('setAgentVersion');
        $setAgentVersion->invokeArgs($suggestion, [1]);

        $setRequestSource = self::getMethod('setRequestSource');
        $setRequestSource->invokeArgs($suggestion, ['google']);

        return $suggestion;
    }

    private function getSuggestionV1Facebook()
    {
        $suggestion = Suggestion::create(['Quick Reply 1', 'Quick Reply 2']);

        $setAgentVersion = self::getMethod('setAgentVersion');
        $setAgentVersion->invokeArgs($suggestion, [1]);

        $setRequestSource = self::getMethod('setRequestSource');
        $setRequestSource->invokeArgs($suggestion, ['facebook']);

        return $suggestion;
    }

    private function getSuggestionV2Google()
    {
        $suggestion = Suggestion::create(['Quick Reply 1', 'Quick Reply 2']);

        $setAgentVersion = self::getMethod('setAgentVersion');
        $setAgentVersion->invokeArgs($suggestion, [2]);

        $setRequestSource = self::getMethod('setRequestSource');
        $setRequestSource->invokeArgs($suggestion, ['google']);

        return $suggestion;
    }

    private function getSuggestionV2Facebook()
    {
        $suggestion = Suggestion::create(['Quick Reply 1', 'Quick Reply 2']);

        $setAgentVersion = self::getMethod('setAgentVersion');
        $setAgentVersion->invokeArgs($suggestion, [2]);

        $setRequestSource = self::getMethod('setRequestSource');
        $setRequestSource->invokeArgs($suggestion, ['facebook']);

        return $suggestion;
    }

    public function testCreate()
    {
        $suggestion = $this->getSuggestionV1Google();

        $this->assertInstanceOf('\Dialogflow\RichMessage\Suggestion', $suggestion);
    }

    public function testRenderV1Google()
    {
        $suggestion = $this->getSuggestionV1Google();
        $this->assertEquals([
            'type'        => 'suggestion_chips',
            'platform'    => 'google',
            'suggestions' => [
                [
                    'title' => 'Quick Reply 1',
                ],
                [
                    'title' => 'Quick Reply 2',
                ],
            ],
        ], $suggestion->render());
    }

    public function testRenderV2Google()
    {
        $suggestion = $this->getSuggestionV2Google();
        $this->assertEquals([
            'platform'    => 'ACTIONS_ON_GOOGLE',
            'suggestions' => [
                'suggestions' => [
                    [
                        'title' => 'Quick Reply 1',
                    ],
                    [
                        'title' => 'Quick Reply 2',
                    ],
                ],
            ],
        ], $suggestion->render());
    }

    public function testRenderV1Facebook()
    {
        $suggestion = $this->getSuggestionV1Facebook();
        $this->assertEquals([
            'type'    => 2,
            'replies' => [
                'Quick Reply 1',
                'Quick Reply 2',
            ],
            'platform' => 'facebook',
        ], $suggestion->render());
    }

    public function testRenderV2Facebook()
    {
        $suggestion = $this->getSuggestionV2Facebook();
        $this->assertEquals([
            'platform'     => 'FACEBOOK',
            'quickReplies' => [
                'quickReplies' => [
                    'Quick Reply 1',
                    'Quick Reply 2',
                ],
            ],
        ], $suggestion->render());
    }

    public function testRenderV2FacebookSingle()
    {
        $suggestion = $this->getSuggestionV2Facebook();
        $suggestion->reply('Single quick reply');
        $this->assertEquals([
            'platform'     => 'FACEBOOK',
            'quickReplies' => [
                'quickReplies' => [
                    'Single quick reply',
                ],
            ],
        ], $suggestion->render());
    }
}
