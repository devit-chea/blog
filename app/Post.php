<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // teabe name
    protected $table = 'posts';
    public $primarykey = 'id' ;
    public $timestamp = true;
}
