<?php

namespace Omnipay\PayPalych\Message;

use Omnipay\Common\Exception\InvalidResponseException;

class CompletePurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $input = request()->input();

        $providedSign = strtoupper((string) ($input['SignatureValue'] ?? ''));
        $outSum = (string) ($input['OutSum'] ?? '');
        $invId = (string) ($input['InvId'] ?? '');
        $status = strtoupper((string) ($input['Status'] ?? ''));

        if ($outSum === '' || $invId === '') {
            throw new InvalidResponseException('Missing OutSum or InvId');
        }

        $apiToken = (string) $this->getApiToken();
        $expectedSign = strtoupper(md5($outSum . ':' . $invId . ':' . $apiToken));

        if (!hash_equals($expectedSign, $providedSign)) {
            throw new InvalidResponseException('Invalid signature');
        }

        return [
            'status' => $status,
            'amount' => (float) $outSum,
            'reference' => $invId,
        ];
    }

    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
