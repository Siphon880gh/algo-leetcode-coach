<?php
declare(strict_types=1);

return [
    'title' => 'Hash Table with Chaining',
    'summary' => 'Each key goes to bucket key mod capacity; keys that share a bucket are chained in a list. A lookup jumps to the bucket and compares keys only inside that chain, so it is expected O(1) when chains stay short.',
    'category' => 'Data Structures',
    'subcategory' => 'Hash Table',
    'topic' => 'Data Structures · Hash Table',
    'tags' => ['hash', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'hash-table',
    'related_session' => 'hash-table',
];
