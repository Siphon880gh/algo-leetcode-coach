<?php
declare(strict_types=1);

return [
    'title' => 'Hashing: remove the O(n²) rescan',
    'summary' => 'On [4, 1, 9, 1, 4], replace the nested scans with a set of seen values and weigh the memory cost.',
    'category' => 'Algorithms',
    'subcategory' => 'Hashing',
    'tags' => ['hashing', 'tradeoff', 'step-by-step'],
    'related_guide' => 'hash-optimization-strategy',
    'topic' => 'Algorithms · Hashing',
    'related_game' => 'hash-optimization-strategy-game',
];
