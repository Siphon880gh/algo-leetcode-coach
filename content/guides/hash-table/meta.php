<?php
declare(strict_types=1);

return [
    'title' => 'Hash table: average O(1) key lookup',
    'summary' => 'Hash the key to a bucket, then equality-check collisions — expected O(1) get/put if the load factor stays bounded.',
    'category' => 'Data Structures',
    'subcategory' => 'Hash Map',
    'kind' => 'algo',
    'tags' => ['hash-table', 'hash-map', 'O(1)'],
    'related_session' => 'hash-table',
    'topic' => 'Data Structures · Hash Map',
    'related_game' => 'hash-table-game',
];
