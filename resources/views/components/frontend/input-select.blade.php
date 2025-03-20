<div class="form_box">
    <label for="{{ $name }}"
        class="form-label mb-2 font-18 font-heading fw-600">{{ $label }}</label>
    <div class="">
        <select {{ $attributes->merge(['class' => 'common-input border select_2']) }}
            name="{{ $name }}">
            <option value="">{{ __('Select') }}</option>
            {{ $slot }}
        </select>
    </div>
</div>