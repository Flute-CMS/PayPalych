<?php

namespace Omnipay\PayPalych\Message;

use Omnipay\Common\Message\AbstractRequest as OmnipayRequest;

abstract class AbstractRequest extends OmnipayRequest
{
    public function getShopId()
    {
        return $this->getParameter('shop_id');
    }

    public function setShopId($value)
    {
        return $this->setParameter('shop_id', $value);
    }

    public function getApiToken()
    {
        return $this->getParameter('api_token');
    }

    public function setApiToken($value)
    {
        return $this->setParameter('api_token', $value);
    }

    public function getBaseUrl()
    {
        return rtrim($this->getParameter('base_url') ?: 'https://pal24.pro', '/');
    }

    public function setBaseUrl($value)
    {
        return $this->setParameter('base_url', $value);
    }
}
