<?php
declare(strict_types=1);

return [
    'title' => 'Top k: a small heap beats a full sort',
    'summary' => 'Keep a min-heap of size k to track the k largest values so far, which takes O(n log k) time instead of O(n log n) for sorting.',
    'category' => 'Algorithms',
    'subcategory' => 'Heap',
    'kind' => 'algo',
    'tags' => ['top-k', 'heap'],
    'related_session' => 'top-k-problem',
    'topic' => 'Algorithms · Heap',
    'related_game' => 'top-k-problem-game',
];
