<?php
declare(strict_types=1);

return [
    'title' => 'Recover the Original Array: try each k from the smallest value',
    'leetcode' => 2122,
    'difficulty' => 'Hard',
    'summary' => 'After sorting, the smallest number is lower[...] of something, so 2k = nums[i] − nums[0] for some i. For each positive even candidate, greedily pair each smallest unused x with x + 2k; if all pair up, output the midpoints.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'hash-table', 'sorting', 'leetcode'],
    'related_session' => 'recover-the-original-array',
];
