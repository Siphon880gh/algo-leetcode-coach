<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Size of a Set After Removals: unique values first, then shared',
    'leetcode' => 3002,
    'difficulty' => 'Med',
    'summary' => 'Each array keeps n/2 values. Keep values only that array has first (up to n/2 each), then fill the remaining room with values both have. The answer is min(min(a, n/2) + min(b, n/2) + c, n).',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'hash-table', 'leetcode'],
    'related_session' => 'maximum-size-of-a-set-after-removals',
];
