<?php declare(strict_types=1);

// Copyright 2023 The Stellar PHP SDK Authors. All rights reserved.
// Use of this source code is governed by a license that can be
// found in the LICENSE file.

namespace Soneso\StellarSDK\Xdr;

class XdrContractCodeEntry
{
    public XdrExtensionPoint $ext;
    public string $cHash; // hash
    public XdrDataValueMandatory $code;


    /**
     * @param XdrExtensionPoint $ext
     * @param string $cHash
     * @param XdrDataValueMandatory $code
     */
    public function __construct(XdrExtensionPoint $ext, string $cHash, XdrDataValueMandatory $code)
    {
        $this->ext = $ext;
        $this->cHash = $cHash;
        $this->code = $code;
    }


    public function encode(): string {
        $bytes = $this->ext->encode();
        $bytes .= XdrEncoder::opaqueFixed($this->contractID,32);
        $bytes .= $this->code->encode();
        return $bytes;
    }

    public static function decode(XdrBuffer $xdr) : XdrContractCodeEntry {
        $ext = XdrExtensionPoint::decode($xdr);
        $cHash = $xdr->readOpaqueFixed(32);
        $code = XdrDataValueMandatory::decode($xdr);

        return new XdrContractCodeEntry($ext, $cHash, $code);
    }

    /**
     * @return XdrExtensionPoint
     */
    public function getExt(): XdrExtensionPoint
    {
        return $this->ext;
    }

    /**
     * @param XdrExtensionPoint $ext
     */
    public function setExt(XdrExtensionPoint $ext): void
    {
        $this->ext = $ext;
    }

    /**
     * @return string
     */
    public function getCHash(): string
    {
        return $this->cHash;
    }

    /**
     * @param string $cHash
     */
    public function setCHash(string $cHash): void
    {
        $this->cHash = $cHash;
    }

    /**
     * @return XdrDataEntry
     */
    public function getCode(): XdrDataEntry
    {
        return $this->code;
    }

    /**
     * @param XdrDataEntry $code
     */
    public function setCode(XdrDataEntry $code): void
    {
        $this->code = $code;
    }
}