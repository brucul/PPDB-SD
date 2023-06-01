<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'dob' => 'date',
    ];

    public function parents()
    {
        return $this->hasMany(StudentParent::class);
    }

    public function document()
    {
        return $this->hasOne(Document::class);
    }

    public function otherDocuments()
    {
        return $this->hasMany(OtherDocument::class);
    }

    public function guardian()
    {
        return $this->hasOne(Guardian::class);
    }
}
