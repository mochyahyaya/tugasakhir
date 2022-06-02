@props([
    'options' => "{
        dateFormat:'Y-m-d H:i:s', 
        altFormat:'G:i K, F j, Y', 
        altInput:true, 
        enableTime:true, 
        locale: 'id',
        minDate:'today'}",
])

<div wire:ignore>
    <input x-data="{value: @entangle($attributes->wire('model')), instance: undefined}" x-init="() => {
         $watch('value', value => instance.setDate(value, true))
         instance = flatpickr($refs.input, {{ $options }} );
    }" x-ref="input" type="text" data-input {{ $attributes }} />
    
</div>