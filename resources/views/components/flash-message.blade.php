@if ($message)
    <div class="p-4 mb-4 text-sm rounded-lg
        {{ $type === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
        <p>{{ $message }}</p>
    </div>
@endif
