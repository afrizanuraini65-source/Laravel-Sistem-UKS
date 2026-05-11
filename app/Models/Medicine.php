<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $guarded = ['id'];

    public function treatments()
    {
        return $this->belongsToMany(Treatment::class, 'treatment_details')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
