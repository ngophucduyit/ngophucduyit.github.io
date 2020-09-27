<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class news extends Eloquent
{
    //
    protected $collection = 'news';
    protected $connection = 'mongodb';
}
