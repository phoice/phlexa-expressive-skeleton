<?php
/**
 * Skeleton application to build voice applications for Amazon Alexa with phlexa, PHP and Mezzio
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa-mezzio-skeleton
 * @link       https://www.phoice.tech/
 * @link       https://www.travello.audio/
 */

namespace Hello\Config;

use Hello\ConfigProvider;
use Interop\Container\ContainerInterface;
use PhlexaMezzio\Handler\HtmlPageHandler;
use PhlexaMezzio\Handler\SkillHandler;
use Mezzio\Application;
use Laminas\ServiceManager\Factory\DelegatorFactoryInterface;

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

        $application->post('/hello', SkillHandler::class, 'hello')
            ->setOptions(['defaults' => ['skillName' => ConfigProvider::NAME]]);

        $application->get('/hello/privacy', HtmlPageHandler::class, 'hello-privacy')
            ->setOptions(['defaults' => ['template' => 'hello::privacy']]);

        $application->get('/hello/terms', HtmlPageHandler::class, 'hello-terms')
            ->setOptions(['defaults' => ['template' => 'hello::terms']]);

        return $application;
    }
}
