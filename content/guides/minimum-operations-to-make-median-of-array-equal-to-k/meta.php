<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make Median of Array Equal to K: one side each',
    'leetcode' => 3107,
    'difficulty' => 'Med',
    'summary' => 'Sort; the median sits at index n/2 (rounded down, which is the larger middle for even n). Lower every element at or before it that exceeds k, and raise every element at or after it that is below k.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'sorting', 'leetcode'],
    'related_session' => 'minimum-operations-to-make-median-of-array-equal-to-k',
];
