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
                <th>product id</th>
                <th>product name</th>
                <th>category</th>
                <th>store</th>
                <th>status</th>
                <th>created at</th>
                <th colspan="2"> action</th>
            </tr>
        </thead>
        <tbody>
            @if ($products->count() > 0)

                @foreach ($products as $product)

                        <tr>
                            <td><img src="{{asset( 'storage/'. $product->image) }} " height="50px" width="50px" alt=""></td>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            {{-- <td>{{$product->category->name ?? 'No Category'}}</td> --}}
                            <td>{{$product->category->name }}</td>
                            <td>{{$product->store->name}}</td>
                            <td>{{$product->status}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>
                                <a href="{{ route('dashboard.products.edit',$product->id) }} " class="btn btn-success">edit</a>
                            </td>

                            <td>
                                <form action="{{ route('dashboard.products.destroy',$product->id) }}" method="post">
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
                <td colspan="7">no products</td>

            </tr>
        @endif
    </table>

    {{ $products->withquerystring()->links() }}
@endsection