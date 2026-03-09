@php
    $settings = $gateway ? $gateway->getSettings() : [];

    if (empty($settings)) {
        $settings = [
            'shop_id' => '',
            'api_token' => '',
            'base_url' => 'https://pal24.pro',
        ];
    }

    $resultUrl = url('/api/lk/handle/PayPalych')->get();
@endphp

<x-alert type="info" withClose="false" class="mb-0">
    <p class="mb-2">В личном кабинете PayPalych (pally.info) укажите следующие URL:</p>
    <ul class="mb-0">
        <li><strong>Result URL:</strong> <code>{{ $resultUrl }}</code></li>
    </ul>
</x-alert>

<x-forms.field>
    <x-forms.label for="settings__shop_id" required>Shop ID:</x-forms.label>
    <x-fields.input name="settings__shop_id" id="settings__shop_id"
        value="{{ request()->input('settings__shop_id', $settings['shop_id']) }}" placeholder="Вставьте сюда shop_id"
        required />
</x-forms.field>

<x-forms.field>
    <x-forms.label for="settings__api_token" required>API Token:</x-forms.label>
    <x-fields.input name="settings__api_token" id="settings__api_token" type="password"
        value="{{ request()->input('settings__api_token', $settings['api_token']) }}"
        placeholder="Вставьте сюда API токен" required />
</x-forms.field>

<x-forms.field>
    <x-forms.label for="settings__base_url">API Base URL:</x-forms.label>
    <x-fields.input name="settings__base_url" id="settings__base_url"
        value="{{ request()->input('settings__base_url', $settings['base_url'] ?? 'https://pal24.pro') }}"
        placeholder="https://pal24.pro" />
    <small class="form-text text-muted">
        Используйте <code>https://pal24.pro</code> для PayPalych или <code>https://cardlink.link</code> для CardLink
    </small>
</x-forms.field>
