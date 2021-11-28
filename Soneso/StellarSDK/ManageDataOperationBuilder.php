<?php declare(strict_types=1);

// Copyright 2021 The Stellar PHP SDK Authors. All rights reserved.
// Use of this source code is governed by a license that can be
// found in the LICENSE file.

namespace Soneso\StellarSDK;

class ManageDataOperationBuilder
{

    private string $key;
    private ?string $value = null;
    private ?MuxedAccount $sourceAccount = null;

    public function __construct(string $key, ?string $value = null) {
        $this->key = $key;
        $this->value = $value;
    }

    public function setSourceAccount(string $accountId) {
        $this->sourceAccount = new MuxedAccount($accountId);
    }

    public function setMuxedSourceAccount(MuxedAccount $sourceAccount) {
        $this->sourceAccount = $sourceAccount;
    }

    public function build(): ManageDataOperation {
        $result = new ManageDataOperation($this->key, $this->value);
        if ($this->sourceAccount != null) {
            $result->setSourceAccount($this->sourceAccount);
        }
        return $result;
    }
}