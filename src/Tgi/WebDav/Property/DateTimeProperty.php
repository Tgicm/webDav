<?php
/**
 * This file is part of the WebDav package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tgi\WebDav\Property;

use Tgi\WebDav\Property;

/**
 *
 *
 * @author tgicm <cmalfroy@tgi.fr>
 */
class DateTimeProperty extends Property
{
    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * @param string|array $name
     * @param mixed        $value
     */
    public function __construct($name, $value = null)
    {
        parent::__construct($name, $value);
        $this->time = new \DateTime($value);
    }

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }
}
