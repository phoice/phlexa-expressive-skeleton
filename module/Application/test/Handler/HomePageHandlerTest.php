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

namespace ApplicationTest\Handler;

use Application\Handler\HomePageHandler;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response;

/**
 * Class HomePageHandlerTest
 *
 * @package ApplicationTest\Handler
 */
class HomePageHandlerTest extends TestCase
{
    /**
     *
     */
    public function testResponse(): void
    {
        $homePage = new HomePageHandler();

        /** @var ServerRequestInterface $request */
        $request = $this->prophesize(ServerRequestInterface::class)->reveal();

        /** @var Response $response */
        $response = $homePage->handle($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertInstanceOf(Response\JsonResponse::class, $response);

        $json = json_decode((string)$response->getBody());

        $this->assertEquals(
            'Welcome to the phlexa mezzio skeleton application',
            $json->hello
        );
    }
}
