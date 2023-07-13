<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $table='detail';
    protected $fillable=['post_status','tag','post_type'];
    protected $guarded=['image'];

    public function post(){
        return $this->belongsTo(\App\Models\Post::class,'post_id','id');
    }
}
