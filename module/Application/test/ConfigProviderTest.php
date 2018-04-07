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

namespace ApplicationTest;

use Application\ConfigProvider;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigProviderTest
 *
 * @package ApplicationTest
 */
class ConfigProviderTest extends TestCase
{
    /**
     *
     */
    public function testConfiguration()
    {
        $configProvider = new ConfigProvider();

        $configData = $configProvider();

        $this->assertTrue(is_array($configData));

        $this->assertArrayHasKey('dependencies', $configData);
        $this->assertArrayHasKey('templates', $configData);
    }
}
