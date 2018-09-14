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
use AfriCC\EPP\Frame\Command\Create\Contact as ContactCreate;

/**
 * CONSTANTS
 */
define('FURY_EXT_LANG_EN', 'EN');
define('FURY_EXT_LANG_FR', 'FR');

/**
 * @see https://www.cira.ca
 */
class FuryContact extends ContactCreate implements Extension
{
    protected $extension_xmlns = 'urn:ietf:params:xml:ns:fury-2.0';

    private $prop_cnt = 0;

    public function setLanguage(string $lang=FURY_EXT_LANG_EN)
    {
        $this->set(sprintf('//epp:epp/epp:command/epp:extension/fury:create/fury:properties/fury:property[%d]/fury:key', $this->prop_cnt), 'LANGUAGE');
        $this->set(sprintf('//epp:epp/epp:command/epp:extension/fury:create/fury:properties/fury:property[%d]/fury:value', $this->prop_cnt++), $lang);
    }

    public function setCPR(string $cpr)
    {
        $this->set(sprintf('//epp:epp/epp:command/epp:extension/fury:create/fury:properties/fury:property[%d]/fury:key', $this->prop_cnt), 'CPR');
        $this->set(sprintf('//epp:epp/epp:command/epp:extension/fury:create/fury:properties/fury:property[%d]/fury:value', $this->prop_cnt++), $cpr);
    }

    public function setAgreement()
    {
        $this->set(sprintf('//epp:epp/epp:command/epp:extension/fury:create/fury:properties/fury:property[%d]/fury:key', $this->prop_cnt), 'AGREEMENT_VERSION');
        $this->set(sprintf("//epp:epp/epp:command/epp:extension/fury:create/fury:properties/fury:property[%d]/fury:value[@default='true']", $this->prop_cnt++));
    }

    public function setContactId($prefix='', $len=8) : string {
        $new_id = sprintf('%s%s', $prefix, bin2hex(str_random($len)));
        
        # Contact ID should not exceed 16 chars in total
        if(strlen($new_id) > 16) {
            $new_id = substr($new_id, 0, 16);
        }
        parent::setId($new_id);
        return $new_id;
    }

    public function setAuthInfo($pw = null)
    {
        if(!$pw) {
            $pw = bin2hex(str_random(8)); # 8 = 16 (hex)
        }
        return $this->appendAuthInfo('contact:authInfo/contact:pw', $pw);
    }

    public function getExtensionNamespace()
    {
        return $this->extension_xmlns;
    }
}
