<?php

namespace Omnipay\PayPalych\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return isset($this->data['link_page_url']) && !empty($this->data['link_page_url']);
    }

    public function isRedirect()
    {
        return isset($this->data['link_page_url']);
    }

    public function getRedirectUrl()
    {
        return $this->data['link_page_url'] ?? null;
    }

    public function getTransactionId()
    {
        return $this->data['transactionId'] ?? null;
    }

    public function getMessage()
    {
        return $this->data['message'] ?? ($this->data['error'] ?? null);
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return null;
    }
}
