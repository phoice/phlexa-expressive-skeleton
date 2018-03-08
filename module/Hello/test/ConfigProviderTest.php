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

namespace HelloTest;

use PHPUnit\Framework\TestCase;
use Hello\ConfigProvider;

/**
 * Class ConfigProviderTest
 *
 * @package HelloTest
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
