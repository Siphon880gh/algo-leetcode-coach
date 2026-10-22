<?php
declare(strict_types=1);

return [
    'title' => 'Maximize the Number of Partitions After Operations: memoized greedy with one change',
    'leetcode' => 3003,
    'difficulty' => 'Hard',
    'summary' => 'Simulate the greedy partitioning from left to right with state (index, letters in the current part, change still available). At each index either keep the letter or, if the change is unused, try all 26 letters; a new part starts when the letter would exceed k distinct.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'string', 'dynamic-programming', 'bitmask', 'leetcode'],
    'related_session' => 'maximize-the-number-of-partitions-after-operations',
];
