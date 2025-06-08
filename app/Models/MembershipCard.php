<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MembershipCard
 *
 * Represents membership cards that can be bought by customers.
 *
 * @property int $id
 * @property string $card_name
 * @property string $price
 * @property int $validityDays
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipCard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipCard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipCard query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipCard whereCardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipCard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipCard whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipCard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipCard wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipCard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MembershipCard whereValidityDays($value)
 * @mixin \Eloquent
 */
class MembershipCard extends Model
{
    public $fillable = [
        'card_name',
        'price',
        'validity_days',
        'description',
    ];
}
