<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SolutionForest\FilamentTree\Concern\ModelTree;

class SchemeTemplatePart extends Model
{
    use ModelTree;
    protected $primarykey = 'id';

    protected $fillable = [
        'schemeTemplate_id',
        'schemePart_id',
        'parent_part_id',
        'name',
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
     * @return BelongsTo
     */
    public function schemeTemplatePart(): BelongsTo
    {
        return $this->belongsTo(SchemeTemplatePart::class, 'parent_part_id');
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
