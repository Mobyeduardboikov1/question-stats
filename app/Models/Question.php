<?php

namespace App\Models;

use App\Models\QuestionOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    
    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }
}
