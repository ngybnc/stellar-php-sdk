<?php declare(strict_types=1);

// Copyright 2023 The Stellar PHP SDK Authors. All rights reserved.
// Use of this source code is governed by a license that can be
// found in the LICENSE file.

namespace Soneso\StellarSDK\Xdr;

class XdrConfigSettingEntryExt
{
    public int $discriminant;

    public function __construct(int $discriminant) {
        $this->discriminant = $discriminant;
    }

    public function encode() : string {
        return XdrEncoder::integer32($this->discriminant);
    }

    public static function decode(XdrBuffer $xdr) : XdrConfigSettingEntryExt {
        $v = $xdr->readInteger32();
        return new XdrConfigSettingEntryExt($v);
    }

    /**
     * @return int
     */
    public function getDiscriminant(): int
    {
        return $this->discriminant;
    }

    /**
     * @param int $discriminant
     */
    public function setDiscriminant(int $discriminant): void
    {
        $this->discriminant = $discriminant;
    }
}