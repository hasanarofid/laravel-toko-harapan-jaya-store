<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['nama','alamat','perusahaan','email','telepon'];

    protected $hidden = ['created_at','updated_at'];
}
