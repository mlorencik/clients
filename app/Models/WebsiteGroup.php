<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebsiteGroup extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function websites(): HasMany
    {
        return $this->hasMany(Website::class);
    }
}
