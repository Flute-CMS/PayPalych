<?php

namespace Omnipay\PayPalych;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'PayPalych';
    }

    public function getDefaultParameters()
    {
        return [
            'shop_id' => '',
            'api_token' => '',
            'base_url' => 'https://pal24.pro',
            'currency' => 'RUB',
            'testMode' => false,
        ];
    }

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

    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\\Omnipay\\PayPalych\\Message\\PurchaseRequest', $parameters);
    }

    public function acceptNotification(array $parameters = [])
    {
        return $this->createRequest('\\Omnipay\\PayPalych\\Message\\AcceptNotificationRequest', $parameters);
    }

    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\\Omnipay\\PayPalych\\Message\\CompletePurchaseRequest', $parameters);
    }
}
