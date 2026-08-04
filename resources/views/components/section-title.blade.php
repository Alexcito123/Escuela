@props(['color' => 'educlub'])

@php
    $bars = [
        'educlub' => 'bg-educlub',
        'green' => 'bg-green-pastel',
        'orange' => 'bg-orange-pastel',
        'pink' => 'bg-pink-pastel',
        'lavender' => 'bg-lavender-pastel',
        'blue' => 'bg-blue-dusty',
    ];
    $bar = $bars[$color] ?? 'bg-educlub';
@endphp

<div class="pt-5 mt-1 border-t border-[#F2ECDD]">
    <div class="flex items-center gap-2.5">
        <span class="h-6 w-1.5 rounded-full {{ $bar }}"></span>
        <h3 class="text-base font-bold text-gray-800">{{ $slot }}</h3>
    </div>
</div>
