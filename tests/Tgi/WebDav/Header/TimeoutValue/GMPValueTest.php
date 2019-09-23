<?php
namespace Tgi\WebDav\Header\TimeoutValue;

/**
 *
 * @author tgicm <cmalfroy@tgi.fr>
 *
 */
class GMPValueTest extends \PHPUnit_Framework_TestCase
{

    public function testToString()
    {
        if (! extension_loaded('gmp')) {
            $this->markTestSkipped("For test GMPValue class enable gmp extension. ");
        }
        $value = new GMPValue(4100000000);
        $this->assertEquals("4100000000", $value);
    }
}
