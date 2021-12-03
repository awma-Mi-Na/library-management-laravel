@props(['class' => ''])

@php
$classes = 'container mx-auto max-w-4xl mt-6 ';
if (isset($class)) {
    $classes = $classes . $class;
}
@endphp
<div class="{{ $classes }}">
    {{ $slot }}
</div>
