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

return [
    'phlexa' => [
        'validate_signature' => true,
        'log_requests'       => false,
        'cache_flag'         => true,
        'cache_dir'          => PROJECT_ROOT . '/data/cache/',
    ],
];
