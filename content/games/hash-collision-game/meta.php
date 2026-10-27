<?php
declare(strict_types=1);

return [
    'title' => 'Hash Collisions: Linear Probing',
    'summary' => 'Open addressing with linear probing: key x starts at slot x mod m. If that slot is taken, try the next slot, wrapping from m − 1 to 0, until an empty slot appears.',
    'category' => 'Data Structures',
    'subcategory' => 'Hash Table',
    'topic' => 'Data Structures · Hash Table',
    'tags' => ['hash', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'hash-collision',
    'related_session' => 'hash-collision',
];
