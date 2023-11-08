<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchemeTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $primarykey = 'id';

    /**
     * @return HasMany
     */
    public function schemeTemplatePart(): HasMany
    {
        return $this->hasMany(SchemeTemplatePart::class, 'schemeTemplate_id')
            ->orderBy('order', 'asc');
    }

    public static function makeTree($data, $parent, $deep): string
    {
        $code = '';
        $codeDeep = str_repeat(' ', 4 * $deep);
        foreach ($data as $part) {
            if ($part->parent_part_id === $parent) {
                $runCode = str_replace('__DISPLAY_TEXT__', $part->display_text, $part->schemePart->code);
                $code .= $codeDeep . 'if(randomNumber(1,100) < ' . $part->condition . '){' . PHP_EOL;
                $code .= $codeDeep . '    ' . $runCode . PHP_EOL;
                $code .= self::makeTree($data, $part->id, $deep + 1);
                $code .= $codeDeep . '}' . PHP_EOL;
            }
        }
        return ($code !== '' && $deep > 0 ? PHP_EOL : '') . $code;
    }
}
