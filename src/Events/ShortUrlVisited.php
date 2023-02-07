<?php

namespace JohnPaulMedina\ShortUrl\Events;

use JohnPaulMedina\ShortUrl\Models\ShortUrl;
use JohnPaulMedina\ShortUrl\Models\ShortUrlVisit;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShortUrlVisited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The short URL that was visited.
     *
     * @var ShortUrl
     */
    public $shortURL;

    /**
     * Details of the visitor that visited the short URL.
     *
     * @var ShortUrlVisit
     */
    public $shortURLVisit;

    /**
     * Create a new event instance.
     *
     * @param  ShortUrl  $shortURL
     * @param  ShortURLVisit  $shortURLVisit
     */
    public function __construct(ShortUrl $shortURL, ShortUrlVisit $shortURLVisit)
    {
        $this->shortURL = $shortURL;
        $this->shortURLVisit = $shortURLVisit;
    }
}
