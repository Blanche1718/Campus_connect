@props(['icon'])

@php
$iconClass = $attributes->merge(['class' => 'w-7 h-7'])->get('class');
@endphp

@switch($icon)
    @case('megaphone')
        <x-heroicon-o-megaphone :class="$iconClass" />
        @break
    @case('users')
        <x-heroicon-o-users :class="$iconClass" />
        @break
    @case('tag')
        <x-heroicon-o-tag :class="$iconClass" />
        @break
    @case('building-office')
        <x-heroicon-o-building-office :class="$iconClass" />
        @break
    @case('cpu-chip')
        <x-heroicon-o-cpu-chip :class="$iconClass" />
        @break
    @case('calendar')
        <x-heroicon-o-calendar-days :class="$iconClass" />
        @break
    @default
        <x-heroicon-o-question-mark-circle :class="$iconClass" />
@endswitch