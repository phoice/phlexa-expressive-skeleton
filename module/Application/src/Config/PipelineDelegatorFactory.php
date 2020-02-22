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

declare(strict_types=1);

namespace Application\Config;

use Interop\Container\ContainerInterface;
use PhlexaMezzio\Middleware\CheckApplicationMiddleware;
use PhlexaMezzio\Middleware\ConfigureSkillMiddleware;
use PhlexaMezzio\Middleware\LogAlexaRequestMiddleware;
use PhlexaMezzio\Middleware\SetLocaleMiddleware;
use PhlexaMezzio\Middleware\ValidateCertificateMiddleware;
use Mezzio\Application;
use Mezzio\Handler\NotFoundHandler;
use Mezzio\Helper\ServerUrlMiddleware;
use Mezzio\Helper\UrlHelperMiddleware;
use Mezzio\Router\Middleware\DispatchMiddleware;
use Mezzio\Router\Middleware\ImplicitHeadMiddleware;
use Mezzio\Router\Middleware\ImplicitOptionsMiddleware;
use Mezzio\Router\Middleware\MethodNotAllowedMiddleware;
use Mezzio\Router\Middleware\RouteMiddleware;
use Laminas\ServiceManager\Factory\DelegatorFactoryInterface;
use Laminas\Stratigility\Middleware\ErrorHandler;

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
