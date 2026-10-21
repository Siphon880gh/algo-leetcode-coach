<?php
declare(strict_types=1);

return [
    'title' => 'Random Flip Matrix: virtual Fisher-Yates with a hash map',
    'leetcode' => 519,
    'difficulty' => 'Med',
    'summary' => 'flip() returns a uniformly random 0-cell of an m × n matrix and sets it to 1; reset() clears it. Treat cells as indexes 0..total − 1. Pick r uniform in [0, total − 1], answer map.get(r, r), then map[r] = map.get(total − 1, total − 1) and total −= 1. O(1) per flip, O(flips) memory.',
    'category' => 'LeetCode',
    'subcategory' => 'Randomized',
    'topic' => 'LeetCode · Randomized',
    'kind' => 'algo',
    'tags' => ['randomized', 'hash-table', 'design', 'math', 'leetcode'],
    'related_session' => 'random-flip-matrix',
];
