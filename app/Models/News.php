<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use NewsSources;

/**
 * App\Models\News
 *
 * @property int $id
 * @property string $hash
 * @property int $news_source_id
 * @property string|null $title
 * @property string $theme
 * @property string $url
 * @property string $description
 * @property string $content
 * @property string $date_at
 * @property string|null $created_at
 * @property string|null $deleted_at
 * @property-read NewsSources $source
 * @method static Builder|News newModelQuery()
 * @method static Builder|News newQuery()
 * @method static Builder|News query()
 * @method static Builder|News whereContent($value)
 * @method static Builder|News whereDateAt($value)
 * @method static Builder|News whereDeletedAt($value)
 * @method static Builder|News whereDescription($value)
 * @method static Builder|News whereHash($value)
 * @method static Builder|News whereId($value)
 * @method static Builder|News whereTheme($value)
 * @method static Builder|News whereTitle($value)
 * @method static Builder|News whereUrl($value)
 * @method static Builder|News onlyTrashed()
 * @method static Builder|News whereCreatedAt($value)
 * @method static Builder|News whereNewsSourceId($value)
 * @method static Builder|News withTrashed()
 * @method static Builder|News withoutTrashed()
 * @method static Builder|News filter(Request $request)
 * @mixin Eloquent
 */
class News extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    public $casts = [
        'created_at' => 'date',
        'date_at' => 'date',
    ];

    public function scopeFilter(Builder $query, Request $request)
    {
        if ($request->has('theme')) {

            $query->where('theme', Str::lower($request->get('theme')));
        }

        if ($request->has('source_id')) {

            $query->where('news_source_id', $request->get('source_id'));
        }

        return $query;
    }

    public function getSource(): HasMany
    {
        return $this->hasMany(NewsSources::class);
    }
}
