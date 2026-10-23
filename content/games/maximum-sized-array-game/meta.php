<?php
declare(strict_types=1);

return [
    'title' => 'Maximum-Sized Array: sum of i·(j OR k)',
    'leetcode' => 3344,
    'difficulty' => 'Med',
    'summary' => 'The sum factors as (0 + 1 + … + n − 1) · Σ_{j,k} (j OR k). Binary search the largest n whose sum ≤ s; per bit, (j OR k) has the bit unless both lack it.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-sized-array',
    'related_session' => 'maximum-sized-array',
];
