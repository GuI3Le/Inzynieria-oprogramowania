<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class FitnessClass
 *
 * Represents fitness classes available for customers to register for.
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $available_spots
 * @property int $employee_id
 * @property string $scheduled_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee $employee
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FitnessClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FitnessClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FitnessClass query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FitnessClass whereAvailableSpots($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FitnessClass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FitnessClass whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FitnessClass whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FitnessClass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FitnessClass whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FitnessClass whereScheduledTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FitnessClass whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FitnessClass extends Model
{
    protected $fillable = [
        'name',
        'description',
        'available_spots',
        'employee_id',
        'scheduled_time'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
