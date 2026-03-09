<?php

namespace Flute\Modules\PayPalych\Listeners;

class PaymentListener
{
    public static function registerPayPalych()
    {
        app()->getLoader()->addPsr4('Omnipay\\PayPalych\\', module_path('PayPalych', 'Gateway/'));
        app()->getLoader()->register();
    }
}
