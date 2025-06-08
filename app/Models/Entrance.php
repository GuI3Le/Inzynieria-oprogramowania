<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Entrance
 *
 * Represents customer entrance to the fitness club.
 *
 * @property int $id
 * @property int $customer_id
 * @property string $entrances_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entrance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entrance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entrance query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entrance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entrance whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entrance whereEntrancesDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entrance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entrance whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Entrance extends Model
{
    public $fillable = [
        'customer_id',
        'entrance_date',
    ];
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
