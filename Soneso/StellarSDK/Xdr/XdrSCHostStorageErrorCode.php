<?php declare(strict_types=1);

// Copyright 2023 The Stellar PHP SDK Authors. All rights reserved.
// Use of this source code is governed by a license that can be
// found in the LICENSE file.

namespace Soneso\StellarSDK\Xdr;

class XdrSCHostStorageErrorCode
{
    public int $value;

    const HOST_STORAGE_UNKNOWN_ERROR = 0;
    const HOST_STORAGE_EXPECT_CONTRACT_DATA = 1;
    const HOST_STORAGE_READWRITE_ACCESS_TO_READONLY_ENTRY = 2;
    const HOST_STORAGE_ACCESS_TO_UNKNOWN_ENTRY = 3;
    const HOST_STORAGE_MISSING_KEY_IN_GET = 4;
    const HOST_STORAGE_GET_ON_DELETED_KEY = 5;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function encode(): string
    {
        return XdrEncoder::integer32($this->value);
    }

    public static function decode(XdrBuffer $xdr): XdrSCHostStorageErrorCode
    {
        $value = $xdr->readInteger32();
        return new XdrSCHostStorageErrorCode($value);
    }
}