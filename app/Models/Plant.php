<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Plant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'location_type', 'quantity', 'start_type', 'batch_number', 'batch_plant_number'];
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

}
