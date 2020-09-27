<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class test extends Eloquent
{
    //
    	protected $collection = 'test';
    protected $connection = 'mongodb';
    //
}