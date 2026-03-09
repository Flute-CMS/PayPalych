<?php

namespace Omnipay\PayPalych\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\NotificationInterface;

class AcceptNotificationResponse extends AbstractResponse implements NotificationInterface
{
    public function isSuccessful()
    {
        $status = $this->data['status'] ?? '';

        return in_array($status, ['SUCCESS', 'OVERPAID'], true);
    }

    public function getTransactionId()
    {
        return $this->data['transactionId'] ?? ($this->data['custom'] ?? null);
    }

    public function getTransactionReference()
    {
        return $this->getTransactionId();
    }

    public function getAmount()
    {
        return isset($this->data['amount']) ? (float) $this->data['amount'] : null;
    }

    public function getMessage()
    {
        return $this->data['status'] ?? null;
    }

    public function getTransactionStatus()
    {
        $status = $this->data['status'] ?? '';

        if (in_array($status, ['SUCCESS', 'OVERPAID'], true)) {
            return NotificationInterface::STATUS_COMPLETED;
        }

        if ($status === 'FAIL') {
            return NotificationInterface::STATUS_FAILED;
        }

        return NotificationInterface::STATUS_PENDING;
    }
}
