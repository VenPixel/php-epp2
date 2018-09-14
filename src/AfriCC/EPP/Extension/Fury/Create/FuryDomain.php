<?php

/**
 * This file is an extension of the php-epp2 library to support the Fury platform.
 *
 * (c) Andrew Wyld <awyld@easydns.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace AfriCC\EPP\Extension\Fury\Create;

use AfriCC\EPP\ExtensionInterface as Extension;
use AfriCC\EPP\Frame\Command\Create\Domain as DomainCreate;

/**
 * PRIVACY CONSTANTS
 */
define('FURY_EXT_PRIVACY_ON', 'PRIVATE');
define('FURY_EXT_PRIVACY_OFF', 'PUBLIC');

/**
 * @see https://www.cira.ca
 */
class FuryDomain extends DomainCreate implements Extension
{
    protected $extension_xmlns = 'urn:ietf:params:xml:ns:fury-2.0';

    public function setPrivacy(string $privacy=FURY_EXT_PRIVACY_ON)
    {
        $this->set('//epp:epp/epp:command/epp:extension/fury:create/fury:properties/fury:property/fury:key', 'PRIVACY');
        $this->set('//epp:epp/epp:command/epp:extension/fury:create/fury:properties/fury:property/fury:value', $privacy);
    }

    public function getExtensionNamespace()
    {
        return $this->extension_xmlns;
    }
}
