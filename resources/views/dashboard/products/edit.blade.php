@extends('layouts.dashboard')
@section('title', 'category')
@section('breadcamp')
    @parent
    <li class="breadcrumb-item"><a href="#">products</a></li>

@endsection
@section('content')
    <form action="{{ route('dashboard.products.update',$product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        {{-- <div class="form-group">
            <label for="">Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
        </div>
        <div class="form-group">
            <label for="">category parent</label>
            <select name="parent_id" class="form-control form-select">
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" @selected($category->parent_id ==$parent->id)>{{$parent->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea type="text" name="description" class="form-control">{{$category->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
    <div class="form-group">
        <label for="">status</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status"  value="active" @checked($category->status=='active')>
            <label class="form-check-label" >
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status"  value="archived" @checked($category->status=='archived')>
            <label class="form-check-label" >
                archive
            </label>
        </div>
    </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary"> Save</button>
        </div> --}}
        @include('dashboard.products._form',['btn'=>'ubdate'])
    </form>


   @endsection