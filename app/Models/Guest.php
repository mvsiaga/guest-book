<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\CommonHelper;

class Guest extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'gender', 'address'];
    protected $appends = ['gender_value'];

    public function getGenderValueAttribute()
    {
        $helper = new CommonHelper;
        return $helper->genderList($this->attributes['gender']);
    }
}
