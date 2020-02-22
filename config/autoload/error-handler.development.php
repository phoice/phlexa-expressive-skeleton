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

use Mezzio\Container\WhoopsErrorResponseGeneratorFactory;
use Mezzio\Container\WhoopsFactory;
use Mezzio\Container\WhoopsPageHandlerFactory;
use Mezzio\Middleware\ErrorResponseGenerator;

return [
    'dependencies' => [
        'factories' => [
            ErrorResponseGenerator::class       =>
                WhoopsErrorResponseGeneratorFactory::class,
            'Mezzio\Whoops'            =>
                WhoopsFactory::class,
            'Mezzio\WhoopsPageHandler' =>
                WhoopsPageHandlerFactory::class,
        ],
    ],

    'whoops' => [
        'json_exceptions' => [
            'display'    => true,
            'show_trace' => true,
            'ajax_only'  => true,
        ],
    ],
];
