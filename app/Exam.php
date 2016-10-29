<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $collection = 'exams';
    protected $connection = 'mongodb';
}
