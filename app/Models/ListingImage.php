<?php

namespace App\Models;

use App\Traits\GenerateUuid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model
{
    use HasFactory, GenerateUuid;

    protected $guarded = [ 'id' ];
    protected $appends = ['src'];

    public function getSrcAttribute() {
        return asset("{$this->file_name}");
    }
    protected function listing() {
        return $this->belongsTo(Listing::class);
    }
}
