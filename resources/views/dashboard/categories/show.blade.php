@extends('layouts.dashboard')
@section('title',  $category->name )
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
   
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>category name</th>
                <th>store</th>
                <th>status</th>
                <th>created at</th>
            </tr>
        </thead>
        <tbody>
            @if ($category)
            @php
                 $products=($category->products()->with('store')->paginate()) ;
            @endphp
            
            
                @foreach ($products as $product)

                        <tr>
                            <td><img src="{{asset( 'storage/'. $product->image) }} " height="50px" width="50px" alt=""></td>

                            <td>{{$product->name}}</td>
                            <td>{{$product->store->name}}</td>
                            <td>{{$product->status}}</td>
                            <td>{{$product->created_at}}</td>
                           
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