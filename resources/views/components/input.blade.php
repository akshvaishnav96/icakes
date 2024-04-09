@props(['label', 'id', 'redClass', 'type', 'name', 'valuetext', 'placeholder'])

<div class="mb-5">
    <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
        {{ $label }}
    </label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}"
        value="{{ $valuetext }}"
        class="w-full rounded-md border  bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md border-red-100 {{ $redClass }}" />
</div>
