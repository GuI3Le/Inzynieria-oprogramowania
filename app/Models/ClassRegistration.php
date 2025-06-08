<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ClassRegistration
 *
 * Represent customers registrations for fitness classes.
 *
 * @property int $id
 * @property int $customer_id
 * @property int $fitness_class_id
 * @property string $status
 * @property string $registration_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\FitnessClass $fitnessClass
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassRegistration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassRegistration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassRegistration query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassRegistration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassRegistration whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassRegistration whereFitnessClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassRegistration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassRegistration whereRegistrationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassRegistration whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassRegistration whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClassRegistration extends Model
{
    public $fillable = [
        'customer_id',
        'fitness_class_id',
        'status',
        'registration_date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function fitnessClass(): BelongsTo
    {
        return $this->belongsTo(FitnessClass::class);
    }
}
