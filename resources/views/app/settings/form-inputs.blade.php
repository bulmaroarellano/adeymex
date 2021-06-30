@php $editing = isset($setting) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="bussines_name"
            label="Bussines Name"
            value="{{ old('bussines_name', ($editing ? $setting->bussines_name : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="telephone"
            label="Telephone"
            value="{{ old('telephone', ($editing ? $setting->telephone : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $setting->email : '')) }}"
            maxlength="255"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="logo"
            label="Logo"
            value="{{ old('logo', ($editing ? $setting->logo : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="discount_credit_card"
            label="Discount Credit Card"
            value="{{ old('discount_credit_card', ($editing ? $setting->discount_credit_card : '')) }}"
            max="255"
            step="0.01"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
