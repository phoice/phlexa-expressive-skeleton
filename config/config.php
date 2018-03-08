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

use Zend\ConfigAggregator\ArrayProvider;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

$cacheConfig = [
    'config_cache_path' => 'data/config-cache.php',
];

$pattern = 'config/autoload/{{,*.}global,{,*.}'
    . APPLICATION_ENV . ',{,*.}local}.php';

$aggregator = new ConfigAggregator(
    [
        \Zend\Expressive\Router\ConfigProvider::class,
        Zend\Router\ConfigProvider::class,
        Zend\Validator\ConfigProvider::class,

        PhlexaExpressive\ConfigProvider::class,

        Hello\ConfigProvider::class,
        Application\ConfigProvider::class,

        new ArrayProvider($cacheConfig),
        new PhpFileProvider($pattern),
    ],
    $cacheConfig['config_cache_path']
);

return $aggregator->getMergedConfig();
