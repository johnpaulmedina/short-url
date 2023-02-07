<?php

use JohnPaulMedina\ShortUrl\Facades\ShortUrl;

if (! config('short-url.disable_default_route')) {
    ShortUrl::routes();
}
