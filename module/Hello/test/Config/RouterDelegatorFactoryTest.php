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

namespace HelloTest\Config;

use Hello\Config\RouterDelegatorFactory;
use Hello\ConfigProvider;
use Interop\Container\ContainerInterface;
use PhlexaExpressive\Handler\HtmlPageHandler;
use PhlexaExpressive\Handler\SkillHandler;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use Zend\Expressive\Application;
use Zend\Expressive\Router\Route;

/**
 * Class RouterDelegatorFactoryTest
 *
 * @package ApplicationTest\Config
 */
class RouterDelegatorFactoryTest extends TestCase
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

        /** @var Route|ObjectProphecy $route1 */
        $route1 = $this->prophesize(Route::class);

        /** @var MethodProphecy $route1Method */
        $route1Method = $route1->setOptions(['defaults' => ['skillName' => ConfigProvider::NAME]]);
        $route1Method->shouldBeCalled();

        /** @var MethodProphecy $post1Method */
        $post1Method = $application->post('/hello', SkillHandler::class, 'hello');
        $post1Method->shouldBeCalled()->willReturn($route1->reveal());

        /** @var Route|ObjectProphecy $route2 */
        $route2 = $this->prophesize(Route::class);

        /** @var MethodProphecy $route2Method */
        $route2Method = $route2->setOptions(['defaults' => ['template' => 'hello::privacy']]);
        $route2Method->shouldBeCalled();

        /** @var MethodProphecy $post2Method */
        $post2Method = $application->get('/hello/privacy', HtmlPageHandler::class, 'hello-privacy');
        $post2Method->shouldBeCalled()->willReturn($route2->reveal());

        /** @var Route|ObjectProphecy $route3 */
        $route3 = $this->prophesize(Route::class);

        /** @var MethodProphecy $route3Method */
        $route3Method = $route3->setOptions(['defaults' => ['template' => 'hello::terms']]);
        $route3Method->shouldBeCalled();

        /** @var MethodProphecy $post3Method */
        $post3Method = $application->get('/hello/terms', HtmlPageHandler::class, 'hello-terms');
        $post3Method->shouldBeCalled()->willReturn($route3->reveal());

        $callable = function () use ($application) {
            return $application->reveal();
        };

        $factory = new RouterDelegatorFactory();

        $applicationReturn = $factory($container->reveal(), Application::class, $callable);

        $this->assertEquals($applicationReturn, $application->reveal());
    }
}
