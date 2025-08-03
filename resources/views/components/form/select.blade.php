@props(['name', 'options' => [], 'selected' => null])

<select name="{{$name}}"
{{ $attributes->class([
    'form-control','form-select'
]) }}
>
    @foreach ($options as $value =>$text)
    <option value="{{ $value }} @selected($value == $selected)">{{$text}}</option>
        
    @endforeach
</select>