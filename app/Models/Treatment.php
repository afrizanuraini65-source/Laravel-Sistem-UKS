<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'treatment_details')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
