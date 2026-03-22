@props(['id', 'label', 'placeholder' => 'Choose an option'])

<div class="filter-group">
    <label for="{{ $id }}"
        class="tw-block tw-text-xs tw-text-gray-500 tw-mb-2 tw-font-medium">{{ $label }}</label>
    <select id="{{ $id }}" class="form-select tw-w-full">
        <option value="">{{ $placeholder }}</option>
    </select>
</div>
