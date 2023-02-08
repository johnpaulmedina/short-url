<?php

namespace JohnPaulMedina\ShortUrl\Console\Commands;

class Commands {

    public function __invoke() {
        return [
            BuildShortUrl::class
        ];
    }

}
