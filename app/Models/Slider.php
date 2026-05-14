<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['path'];

    protected $appends = ['path_url'];
    public function getPathUrlAttribute(){
        return asset('storage/'.$this->path);
    }
}
