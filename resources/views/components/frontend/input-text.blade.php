<div class="form_box">
    <label for="{{ $name }}"
        class="form-label mb-2 font-18 font-heading fw-600">{{ $label }}</label>
    <input type="text" class="{{ $attributes->merge(['class' => 'common-input border']) }}" id="name"
        value="{{ $value }}" placeholder="{{ $placeholder }}"
        name="{{ $name }}">
    <x-input-error :message="$errors->first('name')" />
</div> 