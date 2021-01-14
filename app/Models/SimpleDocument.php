<?php


namespace App\Models;



use Jenssegers\Mongodb\Eloquent\Model;

class SimpleDocument extends Model
{
    protected $collection = "simple_collection";
}
