@extends('layouts.dashboard')
@section('title', 'categories')
@section('breadcamp')
    @parent
    <li class="breadcrumb-item"><a href="#">starter</a></li>

@endsection
@section('content')
    <div class="md-5">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary">create categories</a>
                <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-dark">trashed categories</a>

    </div>

    {{-- @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
        
    @endif
    
    @if (session()->has('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
        
    @endif --}}
    <x-alert />
    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-5">
        <x-form.input name='name' placeholder='Name' :value="request('name')" class="mx-2" />
            <select name="status" class="form-control" id="">
                <option value="">ALL</option>
                <option value="active" @selected(request('status')=='active')>active</option>
                <option value="inactive" @selected(request('status')=='inactive')>inactive</option>
            </select>
            <button class="btn btn-dark">filter</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Category id</th>
                <th>category name</th>
                <th>parent</th>
                <th>product number</th>
                <th>status</th>
                <th>created at</th>
                <th colspan="2"> action</th>
            </tr>
        </thead>
        <tbody>
            @if ($categories->count() > 0)

                @foreach ($categories as $category)

                        <tr>
                            <td><img src="{{asset( 'storage/'. $category->image) }} " height="50px" width="50px" alt=""></td>
                            <td>{{$category->id}}</td>
                            <td><a href="{{ route('dashboard.categories.show',$category->id) }}">{{$category->name}}</a></td>
                            <td>{{$category->parent->name}}</td>
                            <td>{{$category->product->name}}</td>
                            <td>{{$category->status}}</td>
                            <td>{{$category->created_at}}</td>
                            <td>
                                <a href="{{ route('dashboard.categories.edit',$category->id) }} " class="btn btn-success">edit</a>
                            </td>

                            <td>
                                <form action="{{ route('dashboard.categories.destroy',$category->id) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                    <button class="btn btn-danger" type="submit">delete</button>

                                </form>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            @else
            <tr>
                <td colspan="7">no categories</td>

            </tr>
        @endif
    </table>

    {{ $categories->withquerystring()->links() }}
@endsection