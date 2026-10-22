<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum of Subsequence With Non-adjacent Elements: segment tree of end states',
    'leetcode' => 3165,
    'difficulty' => 'Hard',
    'summary' => 'Each segment-tree node stores four best sums, by whether its first and last elements are taken. Merging forbids taking both the left’s last and the right’s first, so each update and answer is O(log n).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'array', 'divide-and-conquer', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-sum-of-subsequence-with-non-adjacent-elements',
];
