 @props([
 'name','value'=>'','label'=>''
 ])
 
 <label for="">{{$label}}</label>
 <textarea 
        name="{{ $name }}" 
        {{ $attributes->class([
            'form-control',
        ]) }}
        >{{ old( $name ,$value)}}
 </textarea>
            @error($name)
            <div class="text-danger">
                {{$message }}
            </div>  
@enderror
