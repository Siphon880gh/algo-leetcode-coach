<?php
declare(strict_types=1);

return [
    'title' => 'Character Encoding: UTF-8 Bytes',
    'summary' => 'UTF-8 stores each code point in 1 to 4 bytes: below 128 (ASCII) uses 1 byte, below 2048 uses 2, below 65536 uses 3, the rest (like most emoji) use 4. Byte length and character count are different numbers.',
    'category' => 'Algorithms',
    'subcategory' => 'Strings',
    'topic' => 'Algorithms · Strings',
    'tags' => ['strings', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'character-encoding',
    'related_session' => 'character-encoding',
];
