<?php

namespace Omnipay\PayPalych\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data['status']) && $this->data['status'] === 'SUCCESS';
    }

    public function getTransactionId()
    {
        return $this->data['reference'] ?? null;
    }

    public function getAmount()
    {
        return isset($this->data['amount']) ? (float) $this->data['amount'] : null;
    }

    public function getMessage()
    {
        return $this->data['message'] ?? null;
    }
}
