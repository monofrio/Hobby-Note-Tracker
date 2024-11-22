<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\Log;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location_type',
        'quantity',
        'start_type',
        'batch_number',
        'batch_plant_number',
        'archived'
    ];
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Recalculate the count of active plants in the batch.
     */
    public static function updateBatchCount($batchNumber)
    {
        // Count active plants in the batch
        $activeCount = self::where('batch_number', $batchNumber)
            ->where('archived', false)
            ->count();

        // Log or return the count if needed
        Log::info("Active plants in batch {$batchNumber}: {$activeCount}");

        return $activeCount; // Dynamically return the count
    }



    /**
     * Override to use a custom builder.
     */
    public function newEloquentBuilder($query): EloquentBuilder
    {
        return new \App\Models\Builder($query);
    }

    /**
     * Add custom query scopes for archived and active plants.
     */
    public function scopeArchived(Builder $query)
    {
        return $query->archived();
    }

    public function scopeActive(Builder $query)
    {
        return $query->active();
    }

}
