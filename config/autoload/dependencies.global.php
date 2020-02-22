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

use Mezzio\Template\TemplateRendererInterface;
use Mezzio\LaminasView\HelperPluginManagerFactory;
use Mezzio\LaminasView\LaminasViewRendererFactory;
use Laminas\View\HelperPluginManager;

return [
    'dependencies' => [
        'factories' => [
            TemplateRendererInterface::class => LaminasViewRendererFactory::class,

            HelperPluginManager::class => HelperPluginManagerFactory::class,
        ],
    ],
];
