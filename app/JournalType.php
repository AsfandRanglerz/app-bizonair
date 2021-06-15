<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalType extends Model
{
    public function journal()
    {
        return $this->belongsTo(\App\Journal::class);
    }
}
