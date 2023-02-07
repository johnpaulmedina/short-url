<?php

namespace JohnPaulMedina\ShortUrl\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ShortUrlVisit.
 *
 * @property int $id
 * @property int $short_url_id
 * @property string $ip_address
 * @property string $operating_system
 * @property string $operating_system_version
 * @property string $browser
 * @property string $browser_version
 * @property string $device_type
 * @property Carbon $visited_at
 * @property string $referer_url
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ShortUrlVisit extends Model
{
    use HasFactory;

    const DEVICE_TYPE_MOBILE = 'mobile';

    const DEVICE_TYPE_DESKTOP = 'desktop';

    const DEVICE_TYPE_TABLET = 'tablet';

    const DEVICE_TYPE_ROBOT = 'robot';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'short_url_visits';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'short_url_id',
        'ip_address',
        'operating_system',
        'operating_system_version',
        'browser',
        'browser_version',
        'visited_at',
        'referer_url',
        'device_type',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'visited_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'short_url_id' => 'integer',
    ];

    /**
     * @return Factory<ShortUrlVisit>
     */
    protected static function newFactory()
    {
        $factoryConfig = config('short-url.factories');

        $modelFactory = app($factoryConfig[__CLASS__]);

        return $modelFactory::new();
    }

    /**
     * A URL visit belongs to one specific shortened URL.
     *
     * @return BelongsTo<ShortUrl, ShortUrlVisit>
     */
    public function shortURL(): BelongsTo
    {
        return $this->belongsTo(ShortUrl::class, 'short_url_id');
    }
}
