<?php
declare(strict_types=1);

return [
    'title' => 'Max Consecutive Ones: running count, reset at zero',
    'leetcode' => 485,
    'difficulty' => 'Easy',
    'summary' => 'Longest run of 1s in a binary array. Keep cnt: add 1 on a 1, reset to 0 on a 0, and track the max. [1,1,0,1,1,1] → 3. [1,0,1,1,0,1] → 2. Not 487 / 1004 (flips allowed).',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'kind' => 'algo',
    'tags' => ['arrays', 'leetcode'],
    'related_session' => 'max-consecutive-ones',
];
