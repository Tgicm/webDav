<?php
/**
 * This file is part of the WebDav package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tgi\WebDav;

/**
 * DAV compliance classes
 *
 * A DAV-compliant resource can advertise several classes of compliance.
 *
 * <code>
 * if ($bitmask & Compliance::CLASS2) {
 *     // A resource that supports WebDAV locking features
 * }
 * </code>
 *
 * @author tgicm <cmalfroy@tgi.fr>
 */
class Compliance
{
    /**
     * Class 1
     */
    const CLASS1 = 1;

    /**
     * Class 2
     */
    const CLASS2 = 2;

    /**
     * Class 3
     */
    const CLASS3 = 4;
}
