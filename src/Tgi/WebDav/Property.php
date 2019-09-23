<?php
/**
 * This file is part of the WebDav package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tgi\WebDav;

use Tgi\WebDav\Property\AbstractProperty;

/**
 * A property of a WebDAV resource
 *
 * @author tgicm <cmalfroy@tgi.fr>
 */
class Property extends AbstractProperty
{
    /**
     * @var mixed The value of this property
     */
    protected $value;

    /**
     * @param string|array $name  The name of this property
     * @param mixed        $value The value of this property
     */
    public function __construct($name, $value = null)
    {
        $this->setName($name);
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public static function fromXml(\DOMElement $element, array $xmlNamespaces = array())
    {
        if (isset($xmlNamespaces[$element->namespaceURI])) {
            $prefix = $xmlNamespaces[$element->namespaceURI];
        } else {
            $prefix = $element->prefix;
        }

        return new static(array($prefix, $element->localName), $element->textContent);
    }
}
