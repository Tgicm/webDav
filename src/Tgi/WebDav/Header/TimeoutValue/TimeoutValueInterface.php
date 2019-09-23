<?php
namespace Tgi\WebDav\Header\TimeoutValue;

/**
 *
 * @author tgicm <cmalfroy@tgi.fr>
 *        
 */
interface TimeoutValueInterface
{

    const INFINITE = - 1;

    /**
     *
     * @return boolean
     */
    public function isInfinite();

    /**
     *
     * @return string
     */
    public function __toString();

    /**
     *
     * @param unknown $time
     */
    public function getValidity($time);
}
