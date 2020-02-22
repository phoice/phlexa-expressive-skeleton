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

use Interop\Container\ContainerInterface;
use Mezzio\Application;

define('PROJECT_ROOT', dirname(__DIR__) . '');
define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: 'production');

chdir(dirname(__DIR__));
require PROJECT_ROOT . '/vendor/autoload.php';

(function () {
    /** @var ContainerInterface $container */
    $container = require PROJECT_ROOT . '/config/container.php';

    /** @var Application $app */
    $app = $container->get(Application::class);
    $app->run();
})();
