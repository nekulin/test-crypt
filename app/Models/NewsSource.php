<?php


namespace App\Models;


use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NewsSource
 *
 * @property int $id
 * @property string $source_id
 * @property string $source_name
 * @property string|null $deleted_at
 *
 * @method static Builder|NewsSource newModelQuery()
 * @method static Builder|NewsSource newQuery()
 * @method static Builder|NewsSource query()
 * @method static Builder|NewsSource whereDeletedAt($value)
 * @method static Builder|NewsSource whereId($value)
 * @method static Builder|NewsSource whereSourceId($value)
 * @method static Builder|NewsSource whereSourceName($value)
 *
 * @mixin Eloquent
 */
class NewsSource extends Model
{
    use HasFactor;

    public $timestamps = false;
}
