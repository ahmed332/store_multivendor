@extends('layouts.dashboard')
@section('title', 'Edit Profile')
@section('breadcamp')
    @parent
    <li class="breadcrumb-item"><a href="#">Edit Profile</a></li>

@endsection
@section('content')
    <form action="{{ route('dashboard.products.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="first_name" lable = 'first name' :value="$user->profile->first_name">
            </div>
             <div class="col-md-6">
                <x-form.input name="first_name" lable = 'last name' :value="$user->profile->last_name">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="birthday" lable = 'birthday' :value="$user->profile->birthday">
            </div>
            <div class="col-md-6">
                <x-form.radio name="gender" lable = 'gender' :options="['male'=>'male','female'=>'female']" :checked="$user->profile->gender">
            </div>
            
        </div>
         <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="street_address" lable = 'street_address' :value="$user->profile->street_address">
            </div>
            <div class="col-md-6">
                <x-form.input name="city" lable = 'city'  :value="$user->profile->city">
            </div>
            
        </div>
         <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="state" lable = 'state'  :value="$user->profile->state">
            </div>
            <div class="col-md-6">
                <x-form.input name="postal_code" lable = 'postal_code' :value="$user->profile->postal_code">
            </div>
            
        </div>
         <div class="form-row">
            <div class="col-md-6">
                <x-form.select name="country" :options="$countries" lable = 'country' :selected="$user->profile->country">
            </div>
           <div class="col-md-6">
                <x-form.select name="local" :options="$locales" lable = 'locale' :selected="$user->profile->locale">
            </div>
            
        </div>
        @include('dashboard.products._form',['btn'=>'ubdate'])
    </form>


   @endsection