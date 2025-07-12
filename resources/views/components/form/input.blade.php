 @props([
 'type'=>'text','name','value'=>'','label'=>''
 ])
 
 <label for="">{{$label}}</label>
 <input type="{{ $type  }}" 
        name="{{ $name }}" 
        value="{{ old( $name ,$value)}}"
        {{ $attributes->class([
            'form-control',
        ]) }}
        >
            @error($name)
            <div class="text-danger">
                {{$message }}
            </div>  
@enderror
