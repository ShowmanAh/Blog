<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //fill data in model to insert data in db directly
    protected $fillable = ['site_name','contact_number','contact_email','address'];
}
