<?php

namespace App\Models;

use App\Traits\GenerateUuid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Offer extends Model
{
    use HasFactory, GenerateUuid;

    protected $guarded = ['id'];

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
    public function bidder()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scopeByMe(Builder $query)
    {
        return $query->where('user_id', Auth::user()?->id);
    }
    public function scopeExcept(Builder $query, $offer)
    {
        return $query->where('id', '!=', $offer->id);
    }
}
