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

use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

$cacheConfig = [
    'config_cache_path' => 'data/cache/config-cache.php',
];

$pattern = 'config/autoload/{{,*.}global,{,*.}'
    . APPLICATION_ENV . ',{,*.}local}.php';

$aggregator = new ConfigAggregator(
    [
        Laminas\HttpHandlerRunner\ConfigProvider::class,
        Mezzio\LaminasView\ConfigProvider::class,
        Mezzio\Router\LaminasRouter\ConfigProvider::class,
        Laminas\Router\ConfigProvider::class,
        Laminas\Validator\ConfigProvider::class,
        Mezzio\Helper\ConfigProvider::class,
        Mezzio\ConfigProvider::class,
        Mezzio\Router\ConfigProvider::class,

        PhlexaMezzio\ConfigProvider::class,

        Hello\ConfigProvider::class,
        Application\ConfigProvider::class,

        new ArrayProvider($cacheConfig),
        new PhpFileProvider($pattern),
    ],
    $cacheConfig['config_cache_path']
);

return $aggregator->getMergedConfig();
