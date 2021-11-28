<?php declare(strict_types=1);

// Copyright 2021 The Stellar PHP SDK Authors. All rights reserved.
// Use of this source code is governed by a license that can be
// found in the LICENSE file.

namespace Soneso\StellarSDK;

use InvalidArgumentException;

class ManageBuyOfferOperationBuilder
{
    private Asset $selling;
    private Asset $buying;
    private string $amount;
    private Price $price;
    private int $offerId = 0;
    private ?MuxedAccount $sourceAccount = null;

    public function __construct(Asset $selling, Asset $buying, string $amount, Price $price) {
        $this->selling = $selling;
        $this->buying = $buying;
        $this->amount = $amount;
        $this->price = $price;
    }

    public function setOfferId(int $offerId) : ManageBuyOfferOperationBuilder {
        if ($offerId < 0) {
            throw new InvalidArgumentException("Invalid offer id: ".$offerId);
        }
        $this->offerId = $offerId;
        return $this;
    }

    public function setSourceAccount(string $accountId) : ManageBuyOfferOperationBuilder {
        $this->sourceAccount = MuxedAccount::fromAccountId($accountId);
        return $this;
    }

    public function setMuxedSourceAccount(MuxedAccount $sourceAccount) : ManageBuyOfferOperationBuilder {
        $this->sourceAccount = $sourceAccount;
        return $this;
    }

    public function build(): ManageBuyOfferOperation {
        $result = new ManageBuyOfferOperation($this->selling, $this->buying, $this->amount, $this->price, $this->offerId);
        if ($this->sourceAccount != null) {
            $result->setSourceAccount($this->sourceAccount);
        }
        return $result;
    }
}