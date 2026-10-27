<?php
declare(strict_types=1);

return [
    'title' => 'Replace Spaces with %20',
    'summary' => 'Each space becomes the three characters %20, so the length grows by 2 per space. Grow the buffer, then fill it from the end with two pointers: read i from the old end, write j from the new end. Writing backward never overwrites a character not yet read.',
    'category' => 'Algorithms',
    'subcategory' => 'Strings',
    'topic' => 'Algorithms · Strings',
    'tags' => ['strings', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'offer05',
    'related_session' => 'offer05',
];
