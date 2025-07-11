@props(['rating' => 0, 'size' => 'w-5 h-5'])

<div class="flex items-center">
    @for ($i = 1; $i <= 5; $i++)
        <svg class="text-yellow-400 {{ $size }}"
             fill="{{ $i <= round($rating) ? 'currentColor' : 'none' }}"
             stroke="currentColor"
             viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
        </svg>
    @endfor
</div>