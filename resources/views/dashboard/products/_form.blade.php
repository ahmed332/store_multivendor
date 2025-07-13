  @if ($errors->any())
      <div class="alert alert-danger">
        <h3>errors</h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
           
        </ul>
      </div>
  @endif
  <div class="form-group">

           <x-form.input name='name' label='category name' :value=" $product->name "/>
           {{-- <x-form.input name='image' type='file'  accept='image/*' /> --}}

        </div>
        <div class="form-group">
            <label for="">category parent</label>
            <select name="parent_id" class="form-control form-select">
                {{-- @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" @selected(old('parent_id',$parent->parent_id)==$parent->id)>{{$parent->name}}</option>
                @endforeach --}}
            </select>
             @error('parent_id')
            <div class="text-danger">
                {{$message }}
            </div>      
            @enderror
        </div>
        <div class="form-group">
            <label for="">Description</label>
            {{-- <textarea type="text" name="description"  class="form-control">{{old('description',$category->description)}}</textarea> --}}
            <x-form.textarea name='description' :value="$product->description" />       
        </div>
        <div class="form-group">
            <label for="">Image</label>
           <x-form.input name='image' type='file'  accept='image/*' />
            @if ($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="" height="60">
            @endif
            
        </div>
    <div class="form-group">
        <label for="">status</label>
        <div>
        <x-form.radio name='status' :checked="$product->status" :options="['active'=>'active','inactive'=>'inactive']" />

        </div>
        {{-- <div class="form-check">
            <input class="form-check-input" type="radio" name="status"  value="active" @checked(old('status',$category->status)=='active')>
            <label class="form-check-label" >
                Active
            </label>
        </div> --}}
        {{-- <div class="form-check">
            <input class="form-check-input" type="radio" name="status"  value="inactive" @checked(old('status',$category->status)=='inactive')>
            <label class="form-check-label" >
                archive
            </label>
        </div> --}}
    </div>  
        <div class="form-group">
            <button type="submit" class="btn btn-primary"> {{ $btn ?? 'save' }}</button>
        </div>
