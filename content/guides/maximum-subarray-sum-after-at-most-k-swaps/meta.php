<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray Sum After at Most K Swaps: top values of window plus outside',
    'leetcode' => 3962,
    'difficulty' => 'Hard',
    'summary' => 'For a window of length L, the best result is the sum of the top L values among the window and the k largest values outside it. Fix the left end, grow the right end, and keep the outside top k and the top L of the window in ordered sets.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'binary-indexed-tree', 'array', 'hash-table', 'ordered-set', 'sorting', 'heap', 'leetcode'],
    'related_session' => 'maximum-subarray-sum-after-at-most-k-swaps',
];
