<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $attributes->merge(['class' => 'w-full px-4 py-2 border rounded shadow-sm focus:ring focus:ring-blue-300 focus:outline-none' . ($errors->has($name) ? ' border-red-500' : '')]) }}
    >
        <option value="">{{ $placeholder ?? 'Select an option' }}</option>
        {{ $slot }}
    </select>
    @error($name)
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
