<?php
/**
 * Skeleton application to build voice applications for Amazon Alexa with phlexa, PHP and Zend\Expressive
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa-expressive-skeleton
 * @link       https://www.phoice.tech/
 * @link       https://www.travello.audio/
 */

declare(strict_types=1);

namespace HelloTest\Intent;

use Hello\Intent\HelloIntent;
use Phlexa\Configuration\SkillConfiguration;
use Phlexa\Intent\AbstractIntent;
use Phlexa\Intent\IntentInterface;
use Phlexa\Request\RequestType\RequestTypeFactory;
use Phlexa\Response\AlexaResponse;
use Phlexa\Session\SessionContainer;
use Phlexa\TextHelper\TextHelper;
use PHPUnit\Framework\TestCase;

class HelloIntentTest extends TestCase
{
    /**
     * Test the instantiation of the class
     */
    public function testInstantiation()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.applicationId',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'intent'    => [
                    'name'  => 'HelloIntent',
                    'slots' => [],
                ],
            ],
        ];

        $alexaRequest       = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse      = new AlexaResponse();
        $textHelper         = new TextHelper();
        $skillConfiguration = new SkillConfiguration();

        $helloIntent = new HelloIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration);

        $this->assertTrue($helloIntent instanceof AbstractIntent);
        $this->assertTrue($helloIntent instanceof IntentInterface);
    }

    /**
     * Test the handling of the intent
     */
    public function testHandle()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.applicationId',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
                'attributes'  => [
                    'count' => 17,
                ]
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'intent'    => [
                    'name'  => 'HelloIntent',
                    'slots' => [],
                ],
            ],
        ];

        $sessionContainer = new SessionContainer(['foo' => 'bar', 'count' => 17,]);

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));
        $textHelper   = new TextHelper();

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setSessionContainer($sessionContainer);

        $skillConfiguration = new SkillConfiguration();
        $skillConfiguration->setSmallImageUrl('https://image.server/small.png');
        $skillConfiguration->setLargeImageUrl('https://image.server/large.png');

        $helloIntent = new HelloIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration);
        $helloIntent->handle();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo'   => 'bar',
                'count' => 18,
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>helloMessage (18)</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'helloTitle',
                    'text'  => 'helloMessage (18)',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }
}
