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

return [
    'phlexa' => [
        'validate_signature' => false,
        'log_requests'       => false,
        'cache_flag'         => false,
        'cache_dir'          => PROJECT_ROOT . '/data/cache/',
    ],
];
