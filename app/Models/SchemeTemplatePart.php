<?php

namespace App\Models;

use http\Client\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SolutionForest\FilamentTree\Concern\ModelTree;

class SchemeTemplatePart extends Model
{
    use ModelTree;

    protected $fillable = [
        'schemeTemplate_id',
        'schemePart_id',
        'parent_part_id',
        'order',
        'condition',
        'display_text'
    ];

    /**
     * @return BelongsTo
     */
    public function schemeTemplate(): BelongsTo
    {
        return $this->belongsTo(SchemeTemplate::class, 'schemeTemplate_id');
    }

    /**
     * @return BelongsTo
     */
    public function schemePart(): BelongsTo
    {
        return $this->belongsTo(SchemePart::class, 'schemePart_id');
    }

    /**
     * @return string
     */
    public function determineParentColumnName(): string
    {
        return "parent_part_id";
    }

    /**
     * @return string
     */
    public function determineTitleColumnName(): string
    {
        return 'display_text';
    }
}
