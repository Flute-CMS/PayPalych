<?php

namespace Flute\Modules\PayPalych\Driver;

use Flute\Core\Modules\Payments\Drivers\AbstractOmnipayDriver;

class PayPalychDriver extends AbstractOmnipayDriver
{
    public ?string $adapter = 'PayPalych';

    public ?string $name = 'PayPalych';

    public ?string $settingsView = 'flute-paypalych::settings';

    public function getValidationRules(): array
    {
        return [
            'settings__shop_id' => ['required', 'string', 'max-str-len:255'],
            'settings__api_token' => ['required', 'string', 'max-str-len:255'],
        ];
    }
}
