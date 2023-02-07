<?php

namespace JohnPaulMedina\ShortUrl\Events;

use JohnPaulMedina\ShortUrl\Models\ShortUrl;
use JohnPaulMedina\ShortUrl\Models\ShortURLVisit;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShortURLVisited
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
     * @var ShortURLVisit
     */
    public $shortURLVisit;

    /**
     * Create a new event instance.
     *
     * @param  ShortUrl  $shortURL
     * @param  ShortURLVisit  $shortURLVisit
     */
    public function __construct(ShortUrl $shortURL, ShortURLVisit $shortURLVisit)
    {
        $this->shortURL = $shortURL;
        $this->shortURLVisit = $shortURLVisit;
    }
}
