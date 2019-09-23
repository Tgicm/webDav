<?php
namespace Tgi\WebDav\Header\TimeoutValue;

/**
 *
 * @author tgicm <cmalfroy@tgi.fr>
 *        
 */
class NativeIntValue implements TimeoutValueInterface
{

    /**
     *
     * @var int
     */
    private $value;

    public function __construct($value)
    {
        $this->value = (int) $value;
    }

    /**
     *
     * (non-PHPdoc)
     *
     * @see \Tgi\WebDav\Header\TimeoutValue\TimeoutValueInterface::__toString()
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }

    /**
     *
     * (non-PHPdoc)
     *
     * @see \Tgi\WebDav\Header\TimeoutValue\TimeoutValueInterface::isInfinite()
     *
     * @return boolean
     */
    public function isInfinite()
    {
        return $this->value < 0;
    }

    /**
     *
     * (non-PHPdoc)
     *
     * @see \Tgi\WebDav\Header\TimeoutValue\TimeoutValueInterface::getValidity()
     *
     * @param unknown $time
     * @return number
     */
    public function getValidity($time)
    {
        return $this->value + $time;
    }
}
