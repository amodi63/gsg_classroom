@props([
    'type'=> 'text',
    'name',
    'id',
    'value' => ''
    ])
    
    <input type="{{ $type}}" name="{{ $name }}" id="{{ $id  ?? $name}}" value ="{{ $value }}" {{ $attributes->class(['form-control' , 'is-invalid' => $errors->has($name)]) }} >

