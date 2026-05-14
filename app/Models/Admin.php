<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use Notifiable,HasFactory;
    protected $fillable = ['name','email','username','super_admin','password','phone_number','status'];
}
