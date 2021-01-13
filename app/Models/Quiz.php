<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Quiz extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

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

    public function getRouteKey(): string
    {
        return Hashids::encode($this->getKey());
    }

    public function resolveRouteBinding($value, $field = null): ?Model
    {
        $value = Hashids::decode($value)[0] ?? null;

        return $this->where($this->getRouteKeyName(), $value)->first();
    }

}
