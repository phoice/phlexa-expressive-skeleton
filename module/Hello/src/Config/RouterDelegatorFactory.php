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

namespace Hello\Config;

use Hello\ConfigProvider;
use Interop\Container\ContainerInterface;
use PhlexaExpressive\Action\HtmlPageAction;
use PhlexaExpressive\Action\SkillAction;
use Zend\Expressive\Application;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;

/**
 * Class RouterDelegatorFactory
 *
 * @package Hello\Config
 */
class RouterDelegatorFactory implements DelegatorFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $name
     * @param callable           $callback
     * @param array|null|null    $options
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        /** @var Application $application */
        $application = $callback();

        $application->post('/hello', SkillAction::class, 'hello')
            ->setOptions(['defaults' => ['skillName' => ConfigProvider::NAME]]);

        $application->get('/hello/privacy', HtmlPageAction::class, 'hello-privacy')
            ->setOptions(['defaults' => ['template' => 'hello::privacy']]);

        $application->get('/hello/terms', HtmlPageAction::class, 'hello-terms')
            ->setOptions(['defaults' => ['template' => 'hello::terms']]);

        return $application;
    }
}
