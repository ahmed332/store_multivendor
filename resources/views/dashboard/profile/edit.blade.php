@extends('layouts.dashboard')
@section('title', 'Edit Profile')
@section('breadcamp')
    @parent
    <li class="breadcrumb-item"><a href="#">Edit Profile</a></li>

@endsection
@section('content')
 
    <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-group">
                <x-form.input name="first_name" label='first name' :value="$user->profile->first_name" />
                <x-form.input name="last_name" label='last name' :value="$user->profile->last_name" />
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="birthday" type="date" label='birthday' :value="$user->profile->birthday" />
            </div>
            <div class="col-md-6">
                <x-form.radio name="gender" label='gender' :options="['male'=>'male','female'=>'female']" :checked="$user->profile->gender" />
            </div>
            
        </div>
         <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="street_address" label='street_address' :value="$user->profile->street_address" />
            </div>
            <div class="col-md-6">
                <x-form.input name="city" label='city'  :value="$user->profile->city" />
            </div>
            
        </div>
         <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="state" label='state'  :value="$user->profile->state" />
            </div>
            <div class="col-md-6">
                <x-form.input name="postal_code" label='postal_code' :value="$user->profile->postal_code" />
            </div>
            
        </div>
         <div class="form-row">
            <div class="col-md-6">
                <x-form.select name='country' :options="$countries" label='country' :selected="$user->profile->country" />
            </div>
           <div class="col-md-6">
                <x-form.select name='local' :options="$locales" label='locale' :selected="$user->profile->local" />
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary">save</button>
    </form>


   @endsection