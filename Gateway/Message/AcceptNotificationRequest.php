<?php

namespace Omnipay\PayPalych\Message;

use Omnipay\Common\Exception\InvalidResponseException;

class AcceptNotificationRequest extends AbstractRequest
{
    public function getData()
    {
        $input = request()->input();

        $providedSign = strtoupper((string) ($input['SignatureValue'] ?? ''));
        $outSum = (string) ($input['OutSum'] ?? '');
        $invId = (string) ($input['InvId'] ?? '');
        $status = strtoupper((string) ($input['Status'] ?? ''));
        $custom = (string) ($input['custom'] ?? '');

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
            'transactionId' => $invId,
            'custom' => $custom,
        ];
    }

    public function sendData($data)
    {
        return $this->response = new AcceptNotificationResponse($this, $data);
    }
}
