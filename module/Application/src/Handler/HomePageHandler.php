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

namespace Application\Handler;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class HomePageHandler
 *
 * @package Application\Handler
 */
class HomePageHandler implements RequestHandlerInterface
{
    /**
     * @param ServerRequestInterface $request
     *
     * @return JsonResponse
     * @throws InvalidArgumentException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse(
            [
                'hello' => 'Welcome to the phlexa skeleton application',
            ]
        );
    }
}
