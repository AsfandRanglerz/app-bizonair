<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    public function category()
    {
        return $this->belongsTo(\App\Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(\App\Subcategory::class);
    }
    public function journalType()
    {
        return $this->belongsTo(\App\JournalType::class);
    }
}
