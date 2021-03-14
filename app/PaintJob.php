<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaintJob extends Model
{
    protected $fillable = ['plate_no','current_color','target_color','status'];
    protected $guarded = ['id'];
}
