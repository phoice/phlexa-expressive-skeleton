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

use Laminas\ServiceManager\ServiceManager;

$config = require __DIR__ . '/config.php';

$dependencies = $config['dependencies'];

$dependencies['services']['config'] = $config;

return new ServiceManager($dependencies);
