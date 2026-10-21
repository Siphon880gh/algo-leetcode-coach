<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Range II: one split point in sorted order',
    'leetcode' => 910,
    'difficulty' => 'Med',
    'summary' => 'After sorting, some prefix moves up by k and the rest moves down by k. For each split i, the new max is max(A[i] + k, A[−1] − k) and the new min is min(A[0] + k, A[i + 1] − k); take the best gap.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'sorting', 'math', 'leetcode'],
    'related_session' => 'smallest-range-ii',
];
