<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
        protected $fillable = ['json', 'status_id'];
}
