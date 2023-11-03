<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Website extends Model
{
    use HasFactory;

    protected $fillable = ['website_group_id', 'name', 'percentage'];

    /**
     * @return BelongsTo
     */
    public function websiteGroup(): BelongsTo
    {
        return $this->belongsTo(WebsiteGroup::class);
    }
}



