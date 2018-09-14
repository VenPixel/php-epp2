<?php

/**
 * This file is an extension of the php-epp2 library to support the Fury platform.
 *
 * (c) Gunter Grodotzki <gunter@afri.cc>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace AfriCC\EPP\Extension\Fury\Info;

use AfriCC\EPP\ExtensionInterface as Extension;
use AfriCC\EPP\Frame\Command\Info\Domain as DomainInfo;

/**
 * @see https://cira.ca
 */
class FuryDomain extends DomainInfo implements Extension
{
    protected $extension_xmlns = 'urn:ietf:params:xml:ns:fury-2.0';

    public function requestBalance()
    {
        $this->set('//epp:epp/epp:command/epp:extension/cozacontact:info/cozacontact:balance', 'true');
    }

    public function requestDomainListing()
    {
        $this->set('//epp:epp/epp:command/epp:extension/cozacontact:info/cozacontact:domainListing', 'true');
    }

    public function requestPrivacy()
    {

    }

    public function getExtensionNamespace()
    {
        return $this->extension_xmlns;
    }
}
