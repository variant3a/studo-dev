<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    
    public function scopeSubjectFilter($query, ?string $subject_name)
    {
        if(isset($subject_name)) $query->where('subject_name', $subject_name); 
        return $query;
    }

    public function scopeKeywordFilter($query, ?string $keyword)
    {
        if(isset($keyword)) $query->where('title', 'like', '%' . $keyword . '%')->orWhere('content', 'like', '%' . $keyword . '%'); 
        return $query;
    }

}
