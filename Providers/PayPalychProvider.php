<?php

namespace Flute\Modules\PayPalych\Providers;

use Flute\Core\Modules\Payments\Events\RegisterPaymentFactoriesEvent;
use Flute\Core\Modules\Payments\Factories\PaymentDriverFactory;
use Flute\Core\Support\ModuleServiceProvider;
use Flute\Modules\PayPalych\Driver\PayPalychDriver;
use Flute\Modules\PayPalych\Listeners\PaymentListener;

class PayPalychProvider extends ModuleServiceProvider
{
    public array $extensions = [];

    public function boot(\DI\Container $container): void
    {
        $this->bootstrapModule();
        $this->loadViews('Resources/views', 'flute-paypalych');
        app(PaymentDriverFactory::class)->register('PayPalych', PayPalychDriver::class);
        events()->addDeferredListener(RegisterPaymentFactoriesEvent::NAME, [PaymentListener::class, 'registerPayPalych']);
    }

    public function register(\DI\Container $container): void
    {
    }
}
