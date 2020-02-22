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

namespace ApplicationTest\Config;

use Application\Config\PipelineDelegatorFactory;
use Interop\Container\ContainerInterface;
use PhlexaMezzio\Middleware\CheckApplicationMiddleware;
use PhlexaMezzio\Middleware\ConfigureSkillMiddleware;
use PhlexaMezzio\Middleware\LogAlexaRequestMiddleware;
use PhlexaMezzio\Middleware\SetLocaleMiddleware;
use PhlexaMezzio\Middleware\ValidateCertificateMiddleware;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use Mezzio\Application;
use Mezzio\Handler\NotFoundHandler;
use Mezzio\Helper\ServerUrlMiddleware;
use Mezzio\Helper\UrlHelperMiddleware;
use Mezzio\Router\Middleware\DispatchMiddleware;
use Mezzio\Router\Middleware\ImplicitHeadMiddleware;
use Mezzio\Router\Middleware\ImplicitOptionsMiddleware;
use Mezzio\Router\Middleware\MethodNotAllowedMiddleware;
use Mezzio\Router\Middleware\RouteMiddleware;
use Laminas\Stratigility\Middleware\ErrorHandler;

/**
 * Class PipelineDelegatorFactoryTest
 *
 * @package ApplicationTest\Config
 */
class PipelineDelegatorFactoryTest extends TestCase
{
    /**
     *
     */
    public function testFactory()
    {
        /** @var ContainerInterface|ObjectProphecy $container */
        $container = $this->prophesize(ContainerInterface::class);

        /** @var Application|ObjectProphecy $application */
        $application = $this->prophesize(Application::class);

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(ErrorHandler::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(ServerUrlMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(RouteMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(ConfigureSkillMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(LogAlexaRequestMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(CheckApplicationMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(ValidateCertificateMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(SetLocaleMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(ImplicitHeadMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(ImplicitOptionsMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(MethodNotAllowedMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(UrlHelperMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(DispatchMiddleware::class);
        $pipeMethod->shouldBeCalled();

        /** @var MethodProphecy $pipeMethod */
        $pipeMethod = $application->pipe(NotFoundHandler::class);
        $pipeMethod->shouldBeCalled();

        $callable = function () use ($application) {
            return $application->reveal();
        };

        $factory = new PipelineDelegatorFactory();

        $applicationReturn = $factory($container->reveal(), Application::class, $callable);

        $this->assertEquals($applicationReturn, $application->reveal());
    }
}
