<?php
declare(strict_types=1);

return [
    'title' => 'Construct Target Array With Multiple Sums',
    'leetcode' => 1354,
    'difficulty' => 'Hard',
    'summary' => 'Work backwards with a max-heap: the largest value x was last set to the sum of the array, so its previous value is x mod (rest sum). Fail if rest ≥ x or the value hits 0 (unless rest is 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['heap', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'construct-target-array-with-multiple-sums',
    'related_session' => 'construct-target-array-with-multiple-sums',
];
