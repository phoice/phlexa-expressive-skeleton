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

return [
    'travello_alexa' => [
        'validate_signature' => false,
        'log_requests'       => false,
        'cache_flag'         => false,
        'cache_dir'          => PROJECT_ROOT . '/data/cache/',
    ],
];
