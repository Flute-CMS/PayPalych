<?php

namespace Omnipay\PayPalych\Message;

class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount', 'transactionId', 'returnUrl');

        return [
            'shop_id' => $this->getShopId(),
            'amount' => (float) $this->getAmount(),
            'currency_in' => $this->getCurrency() ?? 'RUB',
            'order_id' => (string) $this->getTransactionId(),
            'custom' => (string) $this->getTransactionId(),
            'success_url' => $this->getReturnUrl(),
            'fail_url' => $this->getCancelUrl() ?: $this->getReturnUrl(),
            'payer_pays_commission' => 0,
            'type' => 'normal',
        ];
    }

    public function sendData($data)
    {
        $endpoint = $this->getBaseUrl() . '/api/v1/bill/create';

        $headers = [
            'Authorization' => 'Bearer ' . $this->getApiToken(),
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $httpResponse = $this->httpClient->request('POST', $endpoint, $headers, http_build_query($data));

        $responseData = json_decode($httpResponse->getBody()->getContents(), true) ?: [];
        $responseData['transactionId'] = (string) $this->getTransactionId();

        return $this->response = new PurchaseResponse($this, $responseData);
    }
}
