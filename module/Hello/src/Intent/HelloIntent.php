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

namespace Hello\Intent;

use Hello\TextHelper\HelloTextHelper;
use Phlexa\Intent\AbstractIntent;
use Phlexa\Response\AlexaResponse;
use Phlexa\Response\Card\Standard;
use Phlexa\Response\Directives\Display\RenderTemplate;
use Phlexa\Response\Directives\Display\TextContent;
use Phlexa\Response\OutputSpeech\SSML;

/**
 * Class HelloIntent
 *
 * @package Hello\Intent
 * @method HelloTextHelper getTextHelper()
 */
class HelloIntent extends AbstractIntent
{
    const NAME = 'HelloIntent';

    /**
     * @return AlexaResponse
     */
    public function handle(): AlexaResponse
    {
        $sessionContainer = $this->getAlexaResponse()->getSessionContainer();

        $count = $sessionContainer->getAttribute('count') + 1;

        $sessionContainer->setAttribute('count', $count);

        $smallImageUrl = $this->getSkillConfiguration()->getSmallImageUrl();
        $largeImageUrl = $this->getSkillConfiguration()->getLargeImageUrl();

        $title   = $this->getTextHelper()->getHelloTitle();
        $message = $this->getTextHelper()->getHelloMessage() . ' (' . $count . ')';

        $this->getAlexaResponse()->setOutputSpeech(
            new SSML($message)
        );

        if ($this->isDisplaySupported()) {
            $textContent = new TextContent(
                '<font size="7"><b>' . $title . '</b></font>',
                TextContent::TYPE_RICH_TEXT,
                '<font size="3">' . $message . '</font>',
                TextContent::TYPE_RICH_TEXT
            );

            $this->addBodyTemplateDirective(RenderTemplate::TYPE_BODY_TEMPLATE_6, $textContent, 'hello');
        } else {
            $this->getAlexaResponse()->setCard(
                new Standard($title, $message, $smallImageUrl, $largeImageUrl)
            );
        }

        return $this->getAlexaResponse();
    }
}
