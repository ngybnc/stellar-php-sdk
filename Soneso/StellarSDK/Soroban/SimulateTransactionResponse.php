<?php declare(strict_types=1);

// Copyright 2023 The Stellar PHP SDK Authors. All rights reserved.
// Use of this source code is governed by a license that can be
// found in the LICENSE file.

namespace Soneso\StellarSDK\Soroban;

use Soneso\StellarSDK\Footprint;

/**
 * Response that will be received when submitting a trial contract invocation.
 */
class SimulateTransactionResponse extends SorobanRpcResponse
{

    /// Footprint containing the ledger keys expected to be written by this transaction
    public ?Footprint $footprint = null;

    /// Stringified-number of the current latest ledger observed by the node when this response was generated.
    public string $latestLedger;

    /// If error is present then results will not be in the response
    public ?TransactionStatusResults $results = null;

    /// (optional) only present if the transaction failed. This field will include more details from stellar-core about why the invoke host function call failed.
    public ?string $resultError = null;

    /// Information about the fees expected, instructions used, etc.
    public Cost $cost;

    public static function fromJson(array $json) : SimulateTransactionResponse {
        $result = new SimulateTransactionResponse($json);
        if (isset($json['result'])) {
            if (isset($json['result']['error'])) {
                $result->resultError = $json['result']['error'];
            } else if (isset($json['result']['results'])) {
                $result->results = new TransactionStatusResults();
                foreach ($json['result']['results'] as $jsonValue) {
                    $value = TransactionStatusResult::fromJson($jsonValue);
                    $result->results->add($value);
                }
            }
            if (isset($json['result']['footprint']) && $json['result']['footprint'] != "") {
                $result->footprint = Footprint::fromBase64Xdr($json['result']['footprint']);
            }
            if (isset($json['result']['cost'])) {
                $result->cost = Cost::fromJson($json['result']['cost']);
            }
            if (isset($json['result']['latestLedger'])) {
                $result->latestLedger = $json['result']['latestLedger'];
            }
        } else if (isset($json['error'])) {
            $result->error = SorobanRpcErrorResponse::fromJson($json);
        }
        return $result;
    }

    /**
     * @return Footprint  Footprint containing the ledger keys expected to be written by this transaction
     */
    public function getFootprint(): Footprint
    {
        return $this->footprint;
    }

    /**
     * @param Footprint $footprint
     */
    public function setFootprint(Footprint $footprint): void
    {
        $this->footprint = $footprint;
    }

    /**
     * @return string Stringified-number of the current latest ledger observed by the node when this response was generated.
     */
    public function getLatestLedger(): string
    {
        return $this->latestLedger;
    }

    /**
     * @param string $latestLedger
     */
    public function setLatestLedger(string $latestLedger): void
    {
        $this->latestLedger = $latestLedger;
    }

    /**
     * @return TransactionStatusResults|null If error is present then results will not be in the response
     */
    public function getResults(): ?TransactionStatusResults
    {
        return $this->results;
    }

    /**
     * @param TransactionStatusResults|null $results
     */
    public function setResults(?TransactionStatusResults $results): void
    {
        $this->results = $results;
    }


    /**
     * @return string|null Error within the result if an error occurs.
     */
    public function getResultError(): ?string
    {
        return $this->resultError;
    }

    /**
     * @param string|null $resultError
     */
    public function setResultError(?string $resultError): void
    {
        $this->resultError = $resultError;
    }

    /**
     * @return Cost Information about the fees expected, instructions used, etc.
     */
    public function getCost(): Cost
    {
        return $this->cost;
    }

    /**
     * @param Cost $cost
     */
    public function setCost(Cost $cost): void
    {
        $this->cost = $cost;
    }

}