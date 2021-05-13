<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    public $table = 'todos';
    protected $fillable = ['todo_title'];
    protected $primaryKey = 'todo_id';
}
