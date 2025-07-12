@extends('layouts.dashboard')
@section('title', 'categories')
@section('breadcamp')
    @parent
    <li class="breadcrumb-item"><a href="#">starter</a></li>

@endsection
@section('content')
    <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        
        {{-- <div class="form-group">
            <label for="">Category Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">category parent</label>
            <select name="parent_id" class="form-control form-select">
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}">{{$parent->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea type="text" name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
    <div class="form-group">
        <label for="">status</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status"  value="active" checked>
            <label class="form-check-label" >
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status"  value="archived">
            <label class="form-check-label" >
                archive
            </label>
        </div>
    </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary"> Save</button>
        </div> --}}
        @include('dashboard.categories._form')
    </form>
@endsection