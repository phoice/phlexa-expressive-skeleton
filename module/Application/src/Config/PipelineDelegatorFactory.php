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

namespace Application\Config;

use Interop\Container\ContainerInterface;
use PhlexaExpressive\Middleware\CheckApplicationMiddleware;
use PhlexaExpressive\Middleware\ConfigureSkillMiddleware;
use PhlexaExpressive\Middleware\LogAlexaRequestMiddleware;
use PhlexaExpressive\Middleware\SetLocaleMiddleware;
use PhlexaExpressive\Middleware\ValidateCertificateMiddleware;
use Zend\Expressive\Application;
use Zend\Expressive\Handler\NotFoundHandler;
use Zend\Expressive\Helper\ServerUrlMiddleware;
use Zend\Expressive\Helper\UrlHelperMiddleware;
use Zend\Expressive\Router\Middleware\DispatchMiddleware;
use Zend\Expressive\Router\Middleware\ImplicitHeadMiddleware;
use Zend\Expressive\Router\Middleware\ImplicitOptionsMiddleware;
use Zend\Expressive\Router\Middleware\MethodNotAllowedMiddleware;
use Zend\Expressive\Router\Middleware\RouteMiddleware;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;
use Zend\Stratigility\Middleware\ErrorHandler;

/**
 * Class PipelineDelegatorFactory
 *
 * @package Application\Config
 */
class PipelineDelegatorFactory implements DelegatorFactoryInterface
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

        $application->pipe(ErrorHandler::class);
        $application->pipe(ServerUrlMiddleware::class);

        $application->pipe(RouteMiddleware::class);

        $application->pipe(ConfigureSkillMiddleware::class);
        $application->pipe(LogAlexaRequestMiddleware::class);
        $application->pipe(CheckApplicationMiddleware::class);
        $application->pipe(ValidateCertificateMiddleware::class);
        $application->pipe(SetLocaleMiddleware::class);

        $application->pipe(ImplicitHeadMiddleware::class);
        $application->pipe(ImplicitOptionsMiddleware::class);
        $application->pipe(MethodNotAllowedMiddleware::class);
        $application->pipe(UrlHelperMiddleware::class);

        $application->pipe(DispatchMiddleware::class);

        $application->pipe(NotFoundHandler::class);

        return $application;
    }
}
