<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PurchasedMembership
 *
 * Represents purchased membership by customer.
 *
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\MembershipCard|null $membershipCard
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchasedMembership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchasedMembership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchasedMembership query()
 * @mixin \Eloquent
 */
class PurchasedMembership extends Model
{
    public $fillable = [
        'customer_id',
        'membership_card_id',
        'purchase_date',
        'valid_from',
        'valid_until',
        'is_active',
    ];

    public function membershipCard(): BelongsTo
    {
        return $this->belongsTo(MembershipCard::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
